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
  
      console.log(numedident.length );
    if(numedident.length == "" || numedcident.length == ""  || edccatalog.length == ""  || ednccatalog.length == "" 
       || rndefinidas.length == "" || rnimplactejec.length == "" || rndesact.length == ""  || edtrazacatalog.length == ""
       || edtrazafueracatalog.length == "" ){
               Swal.fire({
                   type:'warning',
                   title:'Debe ingresar valores',
               });
      return false;
   }else {

        $.ajax({
        		url:"indicador.php",
        		type:"POST",
        		datatype:"json",
        		data: {numedident:numedident,numedcident:numedcident,edccatalog:edccatalog,ednccatalog:ednccatalog,rndefinidas:rndefinidas,rnimplactejec:rnimplactejec,
        			rndesact:rndesact,dtrazacatalog:dtrazacatalog,edtrazafueracatalog:edtrazafueracatalog},
        		success: function(data){

                   if(data==null){
                   	   Swal.fire({
			                   type:'error',
			                   title:'Debe 12 ingresar valores',
     				         });
                   }else{
                   	  Swal.fire({
			                   type:'success',
			                   title:'Conexion correcta',
			                   confirmButtonText:'Ingresar',
     				         }).then((result) => {
                            if(result.value){
                              window.location.href="index.php";
                            }
     				          }
     				       )
                   }
        		}
        });
   } 
});
