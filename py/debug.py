import sys, os
for path in sys.path:
    print path
print
print 'Root:', os.readlink('/proc/self/root') # Linux only