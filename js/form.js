$('#formIndicador').submit(function (e){
   e.preventDefault();
   var numedident =  $.trim($("#numedident").val());
   var numedcident =  $.trim($("#numedcident").val());
   var edccatalog =  $.trim($("#edccatalog").val());
   var ednccatalog =  $.trim($("#ednccatalog").val());
   var rndefinidas =  $.trim($("#rndefinidas").val());
   var rnimplactejec =  $.trim($("#rnimplactejec").val());
   var rndesact =  $.trim($("#rndesact").val());
   var edtrazacatalog =  $.trim($("#edtrazacatalog").val());
   var edtrazafueracatalog =  $.trim($("#edtrazafueracatalog").val());
  
    if(numedident.lenght == "" || numedcident.lenght == ""  || edccatalog.lenght == ""  || ednccatalog.lenght == "" || rndefinidas.lenght == "" || rnimplactejec.lenght == "" || rndesact.lenght == ""  || edtrazacatalog.lenght == "" || edtrazafueracatalog.lenght == "" ){
       Swal.fire({
                   type:'warning',
                   title:'Debe ingresar valores',
                 });

   }
});
