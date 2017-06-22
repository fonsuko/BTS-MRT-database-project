function check ()
{ //check phone num
  /*var phoneno = /^\d{10}$/;
  if(inputtxt.value.!match(phoneno))
  {
    alert("Not a valid Phone Number");
    document.profile.tel.focus();
    return false;
  }*/
  if (document.profile.memid.value==""){
    alert('Please fill out all required information.');
    document.profile.memid.focus();
    return false;
  }
  elseif (document.profile.name.value==""){
    alert('Please fill out all required information.');
    document.profile.name.focus();
    return false;
  }
  elseif (document.profile.sname.value==""){
    alert('Please fill out all required information.');
    document.profile.sname.focus();
    return false;
  }





}
