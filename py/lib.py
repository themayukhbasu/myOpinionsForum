import pandas as pd
import numpy as np
from sklearn.model_selection import train_test_split
from sklearn.feature_extraction.text import CountVectorizer
from sklearn.naive_bayes import MultinomialNB
from sklearn.metrics import roc_auc_score
from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.externals import joblib

######################################################

def get_raw_data(filename):
	# Extract data from csv file

	data = pd.read_csv(filename)
	header = list(data)
	return header, data

def clean_data(header, data):
	# clean data 
	# replace 'ham' = 0 && 'spam' = 1
	# drops NULL and NAN rows

	data = data.dropna(axis=0,how='any')
	data[header[1]] = np.where(data[header[1]]=='spam',1,0)
	return header, data

def split_data(header, spam_data):
	# Split the data into:
	#	X_train = training data
	#	y_train = training label
	#	X_test = testing data
	#	y_test = testing label

	X_train, X_test, y_train, y_test = train_test_split(spam_data[header[0]], spam_data[header[1]], random_state=0)
	return X_train, X_test, y_train, y_test

def feature_extraction_model():
	# Sets the feature extraction model 

	vect = TfidfVectorizer(min_df=5, ngram_range=(1,3))
	return vect

def feature_fitting(vect, X_train):
	X_train_vectorized = vect.fit_transform(X_train)
	joblib.dump(vect, 'TfidfVectorizer.pkl')
	return X_train_vectorized

def classifier_model():
	clf = MultinomialNB(alpha=0.1,fit_prior=True, class_prior=None)
	return clf

def train_data(clf, X_train_vectorized, y_train):
	clf.fit(X_train_vectorized,y_train)
	joblib.dump(clf, 'MultinomialNB.pkl')
	return clf

def predict_data(clf, vect, X_test):
	predictions = clf.predict(vect.transform(X_test))
	return predictions

def classify(filename):
	header, data = get_raw_data(filename)
	header, data = clean_data(header, data)
	X_train, X_test, y_train, y_test = split_data(header, data)
	vect = feature_extraction_model()
	X_train_vectorized = feature_fitting(vect, X_train)
	clf = classifier_model()
	train_data(clf, X_train_vectorized, y_train)
	predictions = predict_data(clf, vect, X_test)

	return roc_auc_score(predictions,y_test) 


def moderation_check(dat):
	data = []
	data.append(dat)
	vect = joblib.load('TfidfVectorizer.pkl')
	clf = joblib.load('MultinomialNB.pkl')
	return predict_data(clf,vect, data)


################################################

classify('spam.csv')

################################################

def dummy_check():
	text = "SIX chances to win CASH! From 100 to 20,000 pounds txt> CSH11 and send to 87575. Cost 150p/day, 6days, 16+ TsandCs apply Reply HL 4 info"
	print moderation_check(text)
	text = "santa clause is coming to town. A quick brown fox jumps over the lazy dog"
	print moderation_check(text)

dummy_check()