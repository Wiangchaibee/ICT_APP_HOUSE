	function get_pass(i){
		
		$.ajax({
			type: "post",
			url: "show_pass.php",
			dataType: "html",
			data:{num : i},
			success: function(data){
				//alert ($('#main_content').html());
				$('#main_content').html(data);
			}
		});
	}
	
	function update_pass(){
		
		$.ajax({
			type: "post",
			data: $('#edit_pass_member').serialize(),
			url: "update_pass.php",
			dataType: "html",
			success: function(data){
				//alert ($('#main_content').html());
				//$('#main_content').html(data);
				alert (data);
				if(data == 'แก้ไขเสร็จเรียบร้อย' ){
					
							setTimeout(function(){
						
								$.ajax({
									type: "post",
									url: "go_index.php",
									dataType: "html",
									success: function(data){
									//alert ($('#main_content').html());
									$('#main_content').html(data);
									}
								});
						},300);
					
				}
			}
		});
	}
	
	///edit pass by admin
	
	function get_edit_pass(i){
		
		$.ajax({
			type: "post",
			url: "get_edit_pass_admin.php",
			data: {num : i},
			dataType: "html",
			success: function(data){
				//alert ($('#main_content').html());
				$('#main_content').html(data);
			}
		});
	}
	
	function get_pass_admin(){
		
		$.ajax({
			type: "post",
			data: $('#add_pass_member1').serialize(),
			url: "get_pass_admin.php",
			dataType: "html",
			success: function(data){
				//alert (data);
					$('#main_content').html(data);
				
			}
		});
	}
	
	function get_table_pass(c){
		
		$.ajax({
			type: "post",
			data: {num:c},
			url: "show_pass.php",
			dataType: "html",
			success: function(data){
				//alert ($('#main_content').html());
				$('#main_content').html(data);
			}
		});
	}
	
	function update_pass2(){
		
		$.ajax({
			type: "post",
			data: $('#edit_pass_member').serialize(),
			url: "update_pass_admin.php",
			dataType: "html",
			success: function(data){
				//alert ($('#main_content').html());
				//$('#main_content').html(data);
				alert (data);
				if(data == 'แก้ไขเสร็จเรียบร้อย' ){
					
							setTimeout(function(){
						
								$.ajax({
									type: "post",
									url: "go_index.php",
									dataType: "html",
									success: function(data){
									//alert ($('#main_content').html());
									$('#main_content').html(data);
									}
								});
						},300);
					
				}
			}
		});
	}
	/////////////////////////
	function show_2(){
		
		$.ajax({
			type: "post",
			url: "clip_form_2.php",
			dataType: "html",
			success: function(data){
				//alert ($('#main_content').html());
				$('#clip_show').html(data);
			}
		});
	}





function load_edit_profile(){
		
		$.ajax({
			type: "post",
			url: "edit_profile_my_form.php",
			dataType: "html",
			success: function(data){
				//alert ($('#main_content').html());
				$('#main_content').html(data);
			}
		});
	}
	
	
	function load_edit_group_profile(){
		
		$.ajax({
				url: "edit_profile_group_form.php",
				type: "post",
				dataType: "html",
				success: function(data){
					//alert (data);
					$('#main_content').html(data);
				
			
				
				//add event to textbox strat wich s_id
					$('input[id^="student_"]').keyup(function() {
						//alert ($(this).val());
						
						var num = $(this).attr('id')[8];
						var text = $(this).val(); 
						
											
						$.ajax({
						url: "student_list_gen.php",
						type: "post",
						dataType: "text",
						data: {id:$(this).val()},
						success: function(data){
							//alert (data);
							
							if( text == ''){
									$('h#name_'+num).text('');
							
							}
							
							else{
								
								$('h#name_'+num).text(data);
								
								}
							
						
						}
					}); 
						
				});
	
						//add event advisor dropdownlist
				
				$('select[id^="field_"]').change(function() {
					//alert ($(this).val());
					var num = $(this).attr('id')[6];
				$.ajax({
					url: "advisor_list_gen.php",
					type: "post",
					dataType: "html",
					data: {field:$(this).val()},
					success: function(data){
						//alert ('select#advisor_'+num);
						$('select#advisor_'+num).html(data);
					
					
					}
				});	
					
			});
	
	
		}
	});				
	}
	
	
	
	function load_edit_app(){
		
		$.ajax({
			type: "post",
			url: "edit_profile_app_form.php",
			dataType: "html",
			success: function(data){
				//alert ($('#main_content').html());
				$('#main_content').html(data);
			}
		});
	}
	
	
	
		
		
		
function edit_profile(){
		
		//alert ($('#form_profile').serialize());
		$.ajax({
			data: $('#form_profile').serialize(),
			type: "post",
			url: "profile_update.php",
			dataType: "html",
			success: function(data){
				alert (data);
				$('#main_content').html();
				
				setTimeout(function(){
				
						$.ajax({
							type: "post",
							url: "edit_profile_my_form.php",
							dataType: "html",
							success: function(data){
							//alert ($('#main_content').html());
							$('#main_content').html(data);
							}
						});
				},300);
														
			}
		});
	}	
	

function edit_profile_group_student(){
	var form = new FormData(document.getElementById("edit_profile_group_studen"));
	form.append('number2',$('#number2').val());
		$.ajax({
			data: form,
			type: "post",
			url: "edit_profile_group_update.php",
			processData: false, // tell jquery not to process data
			contentType: false, // tel jquery not to set contenttype
			dataType: "html",
			success: function(data){
				alert (data);
				//alert ($('#main_content').html());
				//$('#main_content').html(data);
			}
		});
	}

	
	
	
	function edit_profile_app(){
		
		var form = new FormData(document.getElementById("edit_app_group"));
		
		//alert ($('#form_profile').serialize());
		$.ajax({
			data: form,
			type: "post",
			
			url: "profile_app_update.php",
			processData: false, // tell jquery not to process data
			contentType: false, // tel jquery not to set contenttype
			dataType: "html",
			success: function(data){
				alert (data);
				
				/*setTimeout(function(){
				
						$.ajax({
							type: "post",
							url: "edit_profile_app_form.php",
						
							dataType: "html",
							success: function(data){
							//alert ($('#main_content').html());
							$('#main_content').html(data);
							}
						});
				},30000);
*/														
			}
		});
	}
	
	
 ///////////////////////////////////////////////////////advisor
 
 
 function get_edit_advisor_project(){
		
		$.ajax({
			type: "post",
			url: "edit_advisor_project_form.php",
			dataType: "html",
			success: function(data){
				//alert ($('#main_content').html());
				//alert (data);
				$('#main_content').html(data);
			}
		});
	}
	
	
function advisor_project(){
		var form = new FormData(document.getElementById("search_advisor"));
		//alert ($('#form_profile').serialize());
		$.ajax({
			data: form,
			type: "post",
			url: "search_advisor_project.php",
			processData: false, // tell jquery not to process data
			contentType: false, // tel jquery not to set contenttype
			dataType: "html",
			success: function(data){

				$('#show_search_advisor').html(data);
			}
		});
	}	
 
	function load_edit_app_advisor(path){
		
		$.ajax({
			type: "post",
			data: {i:path},
			url: "advisor_edit_profile_app_form.php",
			dataType: "html",
			success: function(data){
				//alert ($('#main_content').html());
				$('#main_content').html(data);
			$('input[id^="student_"]').keyup(function() {
						//alert ($(this).val());
						
						var num = $(this).attr('id')[8];
						var text = $(this).val(); 
						
											
						$.ajax({
						url: "student_list_gen.php",
						type: "post",
						dataType: "text",
						data: {id:$(this).val()},
						success: function(data){
							//alert (data);
							
							if( text == ''){
									$('h#name_'+num).text('');
							
							}
							
							else{
								
								$('h#name_'+num).text(data);
								
								}
							
						
						}
					}); 
						
				});
	
						//add event advisor dropdownlist
				
				$('select[id^="field_"]').change(function() {
					//alert ($(this).val());
					var num = $(this).attr('id')[6];
				$.ajax({
					url: "advisor_list_gen.php",
					type: "post",
					dataType: "html",
					data: {field:$(this).val()},
					success: function(data){
						//alert ('select#advisor_'+num);
						$('select#advisor_'+num).html(data);
					
					
					}
				});	
					
			});
	
	
		}
	});				
	}
	
	
		function edit_profile_app_advisor(){
			//document.write(i);
		var form = new FormData(document.getElementById("edit_app_group"));
			
		//alert ($('#form_profile').serialize());
		$.ajax({
			data: form,
			//data: {num:i},
			type: "post",
			url: "profile_app_update_advisor.php",
			processData: false, // tell jquery not to process data
			contentType: false, // tel jquery not to set contenttype
			dataType: "html",
			success: function(data){
				alert (data);
				if(data == 'แก้ไขเสร็จเรียบร้อย'){
					setTimeout(function(){
				
						$.ajax({
							type: "post",
							url: "go_index.php",
						
							dataType: "html",
							success: function(data){
							//alert ($('#main_content').html());
							$('#main_content').html(data);
							}
						});
				},300);
					}
				
													
			}
		});
	}
	///////////////////////////////////////////////////////admin
	/////////---------------admin user
	 function get_edit_admin_user(){
		
		$.ajax({
			type: "post",
			url: "edit_admin_user_form.php",
			dataType: "html",
			success: function(data){
				//alert ($('#main_content').html());
				//alert (data);
				$('#main_content').html(data);
			}
		});
	}
	
	
	function admin_user(){
		var form = new FormData(document.getElementById("search_admin_user"));
		//alert ($('#form_profile').serialize());
		$.ajax({
			data: form,
			type: "post",
			url: "search_admin_user.php",
			processData: false, // tell jquery not to process data
			contentType: false, // tel jquery not to set contenttype
			dataType: "html",
			success: function(data){
				//alert ($('#main_content').html());
				//alert (data);
				$('#show_search_admin').html(data);
				
			}
		});
	}	
	
	function load_edit_user_admin(a){
		
		$.ajax({
			type: "post",
			data: {x:a},
			url: "admin_edit_profile_user_form.php",
			dataType: "html",
			success: function(data){
				//alert ($('#main_content').html());
				$('#main_content').html(data);
			}
		});
	}
	
	
	function load_delete_user_admin(a){
		
		$.ajax({
			type: "post",
			data: {s:a},
			url: "admin_delete_profile_user_form.php",
			dataType: "html",
			success: function(data){
				//alert ($('#main_content').html());
				//$('#main_content').html(data);
				alert (data);
				setTimeout(function(){
				
						$.ajax({
							type: "post",
							url: "go_index.php",
							dataType: "html",
							success: function(data){
							//alert ($('#main_content').html());
							$('#main_content').html(data);
							}
						});
				},300);
											
			}
		});
	}
	
	function admin_edit_profile_user(){
		
		//alert ($('#form_profile').serialize());
		//form.append('dateInput',$('#dateInput').val());
		$.ajax({
			data: $('#admin_form_profile').serialize(),
			type: "post",
			url: "admin_profile_user_update.php",
			dataType: "html",
			success: function(data){
				//alert ($('#main_content').html());
				alert (data);
				//$('#main_content').html(data);
				
			}
		});
	}	
	
	////////////////---------admin app
	
	
	
	
	function get_edit_admin_project(){
		
		$.ajax({
			type: "post",
			url: "edit_admin_project_form.php",
			dataType: "html",
			success: function(data){
				//alert ($('#main_content').html());
				//alert (data);
				$('#main_content').html(data);
			}
		});
	}
	
	
		function admin_project(){
		//var form = new FormData(document.getElementById("search_admin_project"));
		//alert ($('#form_profile').serialize());
		$.ajax({
			
			type: "post",
			url: "search_admin_project.php",
			data: $('#search_admin_project').serialize(),
			dataType: "html",
			success: function(data){
				//alert ($('#main_content').html());
				//alert (data);
				if(data == 'กรุณากรอกข้อมูล'){
					alert (data);
					}
				else{
					$('#show_search_admin').html(data);
				}
			}
		});
	}
	
	
	function load_edit_app_admin(num){
		
		$.ajax({
			type: "post",
			data: {i:num},
			url: "admin_edit_profile_app_form.php",
			dataType: "html",
			success: function(data){
				//alert ($('#main_content').html());
				$('#main_content').html(data);
			$('input[id^="student_"]').keyup(function() {
						//alert ($(this).val());
						
						var num = $(this).attr('id')[8];
						var text = $(this).val(); 
						
											
						$.ajax({
						url: "student_list_gen.php",
						type: "post",
						dataType: "text",
						data: {id:$(this).val()},
						success: function(data){
							//alert (data);
							
							if( text == ''){
									$('td#name_'+num).text('');
							
							}
							
							else{
								
								$('td#name_'+num).text(data);
								
								}
							
						
						}
					}); 
						
				});
	
						//add event advisor dropdownlist
				
				$('select[id^="field_"]').change(function() {
					//alert ($(this).val());
					var num = $(this).attr('id')[6];
				$.ajax({
					url: "advisor_list_gen.php",
					type: "post",
					dataType: "html",
					data: {field:$(this).val()},
					success: function(data){
						//alert ('select#advisor_'+num);
						$('select#advisor_'+num).html(data);
					
					
					}
				});	
					
			});
			
	
		}
	});				
}
	
	
	function load_delete_app_admin(num){
		
		$.ajax({
			type: "post",
			data: {i:num},
			url: "admin_delete_profile_app.php",
			dataType: "html",
			success: function(data){
				//alert ($('#main_content').html());
				//$('#main_content').html(data);
				alert (data);
				setTimeout(function(){
				
						$.ajax({
							type: "post",
							url: "go_index.php",
							dataType: "html",
							success: function(data){
							//alert ($('#main_content').html());
							$('#main_content').html(data);
							}
						});
				},300);
			}
		});
	}	
	

		
		function edit_profile_app_admin(){
			//document.write(i);
		var form = new FormData(document.getElementById("edit_app_group"));
		//alert ($('#form_profile').serialize());
		$.ajax({
			data: form,
			//data: {num:i},
			type: "post",
			url: "profile_app_update_admin.php",
			processData: false, // tell jquery not to process data
			contentType: false, // tel jquery not to set contenttype
			dataType: "html",
			success: function(data){
				alert (data);
				if(data == 'แก้ไขเสร็จเรียบร้อย' ){
					
							setTimeout(function(){
						
								$.ajax({
									type: "post",
									url: "go_index.php",
									dataType: "html",
									success: function(data){
									//alert ($('#main_content').html());
									$('#main_content').html(data);
									}
								});
						},300);
					
					}
				
						
			}
		});
	}
	function get_add_admin_member(t){
		
		$.ajax({
			type: "post",
			data: {type:t},
			url: "add_member_form_admin.php",
			dataType: "html",
			success: function(data){
				//alert ($('#main_content').html());
				//alert (data);
				$('#main_content').html(data);
			}
		});
	}
	
	function admin_add_profile_user(){
		var form = new FormData(document.getElementById("form_profile"));
		
		//alert ($('#form_profile').serialize());
		//form.append('dateInput',$('#dateInput').val());
		$.ajax({
			data: form ,
			type: "post",
			url: "profile_user_update_admin.php",
			processData: false, // tell jquery not to process data
			contentType: false, // tel jquery not to set contenttype
			dataType: "html",
			success: function(data){
				//alert ($('#main_content').html());
				if(data == 'ลงทะเบียนเสร็จเรียบร้อยเรียบร้อย'){
				alert (data);
				//$('#main_content').html(data);
				
							setTimeout(function(){
						
								$.ajax({
									type: "post",
									url: "go_index.php",
									dataType: "html",
									success: function(data){
									//alert ($('#main_content').html());
									$('#main_content').html(data);
									}
								});
						},300);
					
				}	
				else{
					alert (data);
				}								
			}
		});
	}	
	
   function select_student(){
		
		//alert ('aaaaaaaaa');
		
			
		$.ajax({
			
			type: "post",
			url: "add_student_group.php",
			dataType: "html",
			success: function(data){
				//alert (data);
				$('#main_content').html(data);
	
			}
		});
	}
	
	
	function load_add_group_profile(){

				var form = new FormData(document.getElementById("add_student"));
				 //alert ('1111');
			$.ajax({
				data: form,
				url: "add_project_form_admin.php",
				processData: false, // tell jquery not to process data
				contentType: false, // tel jquery not to set contenttype
				type: "post",
				dataType: "html",
				success: function(data){
					//alert (data);
					
					$('#main_content').html(data);
				
			
				
				//add event to textbox strat wich s_id
					
	
						//add event advisor dropdownlist
				
				$('select[id^="field_"]').change(function() {
					//alert ($(this).val());
					var num = $(this).attr('id')[6];
				$.ajax({
					url: "advisor_list_gen.php",
					type: "post",
					dataType: "html",
					data: {field:$(this).val()},
					success: function(data){
						//alert ('select#advisor_'+num);
						$('select#advisor_'+num).html(data);
					
					
					}
				});	
					
			});
	
	
		}
	});				
}
	
	
		function create_g_admin(){
		
		//alert ('aaaaaaaaa');
				var form = new FormData(document.getElementById("form_create_admin"));
				
		//form.append('student_1',$('#student_1').val());
		
				
		
			
		$.ajax({
			data: form,
			type: "post",
			url: "add_project_admin.php",
			processData: false, // tell jquery not to process data
			contentType: false, // tel jquery not to set contenttype
			dataType: "text",
			success: function(data){
				alert (data);
				//$('#main_content').text(data);
				if(data == "สร้างกลุ่มเสร็จเรียบร้อย"){
					setTimeout(function(){
				
						$.ajax({
							type: "post",
							url: "go_index.php",
							dataType: "html",
							success: function(data){
							//alert ($('#main_content').html());
							$('#main_content').html(data);
							}
						});
					},300);
				}
					
	
			}
		});
	}
///////////////////////delete comment




	function get_delete_admin_comment(){
		
		$.ajax({
			type: "post",
			url: "delete_admin_comment_form.php",
			dataType: "html",
			success: function(data){
				//alert ($('#main_content').html());
				//alert (data);
				$('#main_content').html(data);
			}
		});
	}

	function admin_comment(){
		var form = new FormData(document.getElementById("search_admin_project_com"));
		$.ajax({
			data: form,
			type: "post",
			url: "delete_admin_comment_update.php",
			processData: false, // tell jquery not to process data
			contentType: false, // tel jquery not to set contenttype
			dataType: "text",
			success: function(data){
				//alert ($('#main_content').html());
				//alert (data);
				if(data == "ไม่มีแอปพลิเคชั่นที่เกี่ยวกับข้อมูลนี้"){
					alert (data);
					
				}else
				$('#main_content').html(data);
			}
		});
	}
	
	

	function load_delete_comment_admin(num){
		
		$.ajax({
			type: "post",
			data: {id:num},
			url: "delete_admin_comment_update2.php",
			dataType: "html",
			success: function(data){
				//alert ($('#main_content').html());
				//alert (data);
				if(data == 'ไม่มีความคิดเห็น'){
					alert (data);	
				}else
				$('#main_content').html(data);
					
			}
		});
	}


function delete_comment_admin(num){
		
		$.ajax({
			type: "post",
			data: {id:num},
			url: "delete_admin_comment_update3.php",
			dataType: "html",
			success: function(data){
				//alert ($('#main_content').html());
				alert (data);
				//$('#main_content').html(data);
				setTimeout(function(){
				
						$.ajax({
							type: "post",
							url: "go_index.php",
							dataType: "html",
							success: function(data){
							//alert ($('#main_content').html());
							$('#main_content').html(data);
							}
						});
				},300);
			}
		});
	}




///////////////////////delete comment end











