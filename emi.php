<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>EMI Calculator</title>

<style type="text/css">
 #myTableStyle
        {
           position:fixed;
           top:15%;
           left:35%; 

            /*Alternatively you could use: */
           /*
              position: fixed;
               bottom: 50%;
               right: 50%;
           */


        }</style>
</head>

<body background="images/body_bg.png"><center>
<div id="myTableStyle">
  
<table >
<tr>
<td valign="top" class="maintxt"><strong class="subheading"><br/><font size="5" color="red">LOAN EMI CALCUALTOR</font> <br></strong><br />
<script language="javascript" type="text/JavaScript">
function clearval(docname) {
docname.txtLoanAmount.value="";
docname.txtInterestRate.value="";
docname.txtPeriod.value="";
docname.resultemi.value="";
docname.Selectopt.selectedIndex=0;
docname.txtLoanAmount.focus();
return false;
}
function checkval(docname){

var i;
var getval=docname.value;
var count_deci=0;
var flag=0;


for(i=0;i<getval.length;i=i+1) { 
if((getval.charAt(i) >= "0" && getval.charAt(i) <= "9") || (getval.charAt(i) == ".")) {	

if(getval.charAt(i) == ".") {
count_deci=count_deci+1;

if(getval.charAt(i+1)=="") { 
alert("Wrong entry"); 
docname.amt.value="";
docname.amt.focus();
flag=1;
break;
}
}

if(count_deci>1) { 
alert("Illegal Data");
docname.amt.value="";
docname.amt.focus();
flag=1;
break;
}
}	
else { 
alert("Invalid Entry");
docname.value="";
docname.focus();
flag=1;
break;
}	
}
}


function CalculateValue(docname) {
subflag = true;

if(subflag) {

var LoanA,IntR,TimeP;
var TypeOfLoan;
var Multiplier,numerator,denominator;
var EMI;

LoanA=docname.txtLoanAmount.value;
IntR=docname.txtInterestRate.value;
TimeP=docname.txtPeriod.value;
TypeOfLoan=docname.Selectopt.value;

if(TypeOfLoan=="Monthly")
Multiplier=12;
else
Multiplier=1;

numerator=LoanA*Math.pow((1+IntR/(Multiplier*100)),TimeP*Multiplier);

denominator=100*Multiplier*((Math.pow((1+IntR/(Multiplier*100)),TimeP*Multiplier)-1)/IntR);

if(TypeOfLoan=="Monthly")
EMI=12*(numerator/(denominator*12));
else
EMI=numerator/denominator;
var emi;
emi=Math.round(EMI);
docname.resultemi.value=emi;

return false;
}
}
</script>
<form name="frmEMI" method="post">
<table bgcolor="#E2D66B" width="90%" border="0" align="left" cellpadding="3" cellspacing="0" class="bdrAll">

<tr>
<td class="headVrar" width="24%">Loan Amount (Rs.)</td>
<td width="76%" align="left"><input type="text" class="input" name="txtLoanAmount" onblur="checkval(document.frmEMI.txtLoanAmount)" size="17"></td>
</tr>
<tr>
<td class="headVr ar" width="24%">Interest Rate (%)</td>
<td align="left">
<input type="text" class="input" name="txtInterestRate" onblur="checkval(document.frmEMI.txtInterestRate)" size="17"></td>
</tr>
<tr>
<td class="headVr ar" width="24%">Loan Period (Yrs)</td>
<td align="left"><input type="text" class="input" name="txtPeriod" onblur="checkval(document.frmEMI.txtPeriod)" size="17"></td>
</tr>
<tr>
<td class="headVr ar" width="24%">Equated Monthly Installment (<b>EMI</b>)</td>
<td align="left" valign="TOP" class="p2px5px"><input type="text" class="input" name="resultemi" size="17" readonly style="BACKGROUND-COLOR='#ffffCC'" /></td>
</tr>
<tr>
<td>&nbsp;</td>
<td align="left" valign="TOP">
<input type="hidden" name="Selectopt" value="Monthly">
<a href="" onclick="return CalculateValue(document.frmEMI);"><input class="button" type="button" name="Submit" value="Calculate" alt="Calculate"></a>&nbsp;&nbsp;<a href="" onclick="return(clearval(document.frmEMI))"><input type="button" name="Submit" value="Clear" alt="Clear All" class="button"></a>&nbsp;&nbsp;<a href="chk.html"><input class="button" type="button" name="Submit" value="Thank You" alt="Home"></a></td>
</tr>

</table>
</form> </td>
</tr>
</table>
</body>
</html>