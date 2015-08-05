function delete_resource(itemid){
  if(confirm('Delete? Ara you sure?')){
    $.ajax({
				type: 'get',
				
      url: 'user_delete.php?id='+itemid,
      async: false,
      dataType: 'json',
				success: function(data){
						// alert(data.msg === '1');
        if(data.msg === '1'){
          $('#user'+'_'+itemid).remove();
        }
      }
    });
  }
  return false;
}
