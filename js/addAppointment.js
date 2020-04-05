function sendAnswer(){
  xmlHttp = new XMLHttpRequest();
  if(xmlHttp){
     try{
          var doctor = document.getElementById('doctor').value;
          var patient = document.getElementById('patient').value;
          var date = document.getElementById('date').value;
          var time = document.getElementById('time').value;
          var cause = document.getElementById('cause').value;
          var amount = document.getElementById('amount').value;
          var is_paid = document.getElementById('is_paid').checked;
          if(amount != 0)
          {
              is_paid = true;
          }
          var theForm, newInput1, newInput2, newInput3, newInput4, newInput5,newInput6,newInput7;
          // Start by creating a <form>
          theForm = document.createElement('form');
          theForm.action = 'controllers.php?sub=Service&action=addAppointmentPost';
          theForm.method = 'post';
          // Next create the <input>s in the form and give them names and values
          newInput1 = document.createElement('input');
          newInput1.type = 'hidden';
          newInput1.name = 'doctor';
          newInput1.value = doctor;
          newInput2 = document.createElement('input');
          newInput2.type = 'hidden';
          newInput2.name = 'patient';
          newInput2.value = patient;
          newInput3 = document.createElement('input');
          newInput3.type = 'hidden';
          newInput3.name = 'date';
          newInput3.value = date;
          newInput4 = document.createElement('input');
          newInput4.type = 'hidden';
          newInput4.name = 'time';
          newInput4.value = time;
          newInput5 = document.createElement('input');
          newInput5.type = 'hidden';
          newInput5.name = 'cause';
          newInput5.value = cause;
          newInput6 = document.createElement('input');
          newInput6.type = 'hidden';
          newInput6.name = 'amount';
          newInput6.value = amount;
          newInput7 = document.createElement('input');
          newInput7.type = 'hidden';
          newInput7.name = 'is_paid';
          newInput7.value = is_paid;
          // Now put everything together...
          theForm.appendChild(newInput1);
          theForm.appendChild(newInput2);
          theForm.appendChild(newInput3);
          theForm.appendChild(newInput4);
          theForm.appendChild(newInput5);
          theForm.appendChild(newInput6);
          theForm.appendChild(newInput7);
          // ...and it to the DOM...
          document.getElementById('hidden_form_container').appendChild(theForm);
          // ...and submit it
          theForm.submit();
      }
      catch (e) {
          alert ("Nie mozna polaczyc sie z serwerem: " + e.toString()) ;
        }
      } 
      else {
        alert ("Blad") ;
      }      
}