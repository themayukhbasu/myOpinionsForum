<html>
<input disabled  maxlength="3" size="3" id="counter">
<input type="text" onkeyup="textCounter(this,'counter',100);" id="message">


<script>
function textCounter(field,field2,maxlimit)
{
 var countfield = document.getElementById(field2);
 if ( field.value.length > maxlimit ) {
  field.value = field.value.substring( 0, maxlimit );
  return false;
 } else {
  countfield.value = field.value.length;
 }
}
</script>

</html>