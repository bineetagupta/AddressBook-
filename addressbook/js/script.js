$(document).ready(function(){
	//Show Loader images
	$('#loaderImage').show();
	
	//showContacts on page load
	showContacts();
	
	//Add contacts
	$(document).on('submit','#addContact', function(){
		//SHow Loader Image
		$('#loaderImage').show();
		
		//Postdata from form
		$.post("add_contact.php",$(this).serialize())
			.done(function(data){
				console.log(data);
				$('#addModal').foundation('reveal','close');
				showContacts();
			});
		return false;
	});
	
	//Edit contact
	$(document).on('submit','#editContact', function(){
		//echo " entered in script js for edit" ;
		//SHow Loader Image
		$('#loaderImage').show();
		
		//Postdata from form
		$.post("edit_contact.php",$(this).serialize())
			.done(function(data){
				console.log(data);
				$('.editModal').foundation('reveal','close');
				showContacts();
			});
		return false;
	});
	
	//Delete contact
	$(document).on('submit','#deleteContact', function(){
		//SHow Loader Image
		$('#loaderImage').show();
		
		//Postdata from form
		$.post("delete_contact.php",$(this).serialize())
			.done(function(data){
				console.log(data);
				//$('.editModal').foundation('reveal','close');
				showContacts();
			});
		return false;
	});
	
});

//Show  Contacts

function showContacts() {
		console.log('Showing Contacts..');
		setTimeout("$('#pageContent').load('contacts.php',function(){$('loaderImage').hide();})",1000);
}

$(document).on('click','.close-reveal-modal', function(){
	$('.reveal-modal').foundation('reveal','close');
});