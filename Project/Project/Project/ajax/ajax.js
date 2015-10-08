function get_download_file(i){
		
		$.ajax({
			type: "post",
			url: "download_file_update.php",
			dataType: "html",
			data: {num:i},
			success: function(data){
				//alert ($('#main_content').html());
				//$('#clip_show').html(data);
				//alert (data);
			}
		});
	}
function get_download_doc(i){
		
		$.ajax({
			type: "post",
			url: "download_doc_update.php",
			dataType: "html",
			data: {num:i},
			success: function(data){
				//alert ($('#main_content').html());
				//$('#clip_show').html(data);
				//alert (data);
			}
		});
	}	
	function get_register(){
		
		$.ajax({
			type: "post",
			url: "form_register.php",
			dataType: "html",
			success: function(data){
				//alert ($('#main_content').html());
				$('#main_content').html(data);
			}
		});
	}
	
function register(){
	var form = new FormData(document.getElementById("form_re"));
	form.append('dateInput',$('#dateInput').val());
		$.ajax({
			data: form,
			type: "post",
			url: "check_re.php",
			processData: false, // tell jquery not to process data
			contentType: false, // tel jquery not to set contenttype
			dataType: "html",
			success: function(data){
				alert (data);
				 if(data == 'สมัครสมาชิกเรียบร้อย'){
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
	
	function check_user(num){
	$('input#id_register').keyup(function() {	
		$.ajax({
			type: "post",
			url: "check_user.php",
			dataType: "text",
			data: { n : num} ,
			
				success: function(data){
					//alert (data);
				
					if('input#id_register' == ''){
						$('div#user11').text('');
							
						}
							
					else{
						
						$('div#user11').text(data);
						
						}
							
			
					//$('#msg_id2').html(data);
				
			}
		});
		});
		}
	

function load_profile(){
		
		$.ajax({
			type: "post",
			url: "profile.php",
			dataType: "html",
			success: function(data){
				//alert ($('#main_content').html());
				$('#main_content').html(data);
			}
		});
	}
	
	
	
$(function(){	
		$('div#score_star2').each(function(){	
				$(this).raty({
						readOnly : true,
						 half  : true,
					  score: function() {
						return $(this).attr('data-rating');
					  }
					});
			});
});		
	
	
						

$(function(){
			$('#slides').slides({
				preload: true,
				preloadImage: 'img/loading.gif',
				play: 5000,
				pause: 2500,
				hoverPause: true,
				animationStart: function(current){
					$('.caption').animate({
						bottom:-35
					},100);
					if (window.console && console.log) {
						// example return of current slide number
						console.log('animationStart on slide: ', current);
					};
				},
				animationComplete: function(current){
					$('.caption').animate({
						bottom:0
					},200);
					if (window.console && console.log) {
						// example return of current slide number
						console.log('animationComplete on slide: ', current);
					};
				},
				slidesLoaded: function() {
					$('.caption').animate({
						bottom:0
					},200);
				}
			});
		});



	

		
		
		
/*function edit_profile(){
		
		//alert ($('#form_profile').serialize());
		$.ajax({
			data: $('#form_profile').serialize(),
			type: "post",
			url: "profile_update.php",
			dataType: "html",
			success: function(data){
				$('#main_content').html(data);
				
				setTimeout(function(){
				
						$.ajax({
							type: "post",
							url: "profile.php",
							dataType: "html",
							success: function(data){
							//alert ($('#main_content').html());
							$('#main_content').html(data);
							}
						});
				},3000);
														
			}
		});
	}		
*/	
	
	
	
	
function group(){
var form = new FormData(document.getElementById("add_student"));
				 //alert ('1111');
			$.ajax({
				data: form,
				url: "group.php",
				processData: false, // tell jquery not to process data
				contentType: false, // tel jquery not to set contenttype
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
	
	
	
	
	
	
	function create_g(){
		
		//alert ('aaaaaaaaa');
				var form = new FormData(document.getElementById("form_create_group"));
				
		form.append('student_1',$('#student_1').val());
		
				
		
			
		$.ajax({
			data: form,
			type: "post",
			url: "create_group.php",
			processData: false, // tell jquery not to process data
			contentType: false, // tel jquery not to set contenttype
			dataType: "text",
			success: function(data){
				alert (data);
				//$('#main_content').text(data);
					if(data == 'สร้างกลุ่มเสร็จเรียบร้อย'){
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
	
	

	
	
	function search(){
		
		$.ajax({
			type: "GET",
			url: "search.php",
			dataType: "html",
			data: $('#form_search').serialize(),
			success: function(data){
				//alert (data);
				$('#main_content').html(data);
				$('div#star_vote').each(function(){	
				$(this).raty({
						readOnly : true,
						 half  : true,
					  score: function() {
						return $(this).attr('data-rating');
					  }
					});
				});
			}	
		});
	}
			
	
	function search_index(x){
		 //alert (x);
		//var s=document.getElementById("game").value=x;
	 	//document.write(s);
		$.ajax({
			data: {a:x},
			type: "GET",
			url: "search_show.php",
			dataType: "html",
			success: function(data){
				//alert (data);
				$('#main_content').html(data);		
			}
		});
	}
	
	
	

	
	
	function get_app(i){
		//alert (i);
		
		$.ajax({
			type: "POST",
			url: "app.php",
			dataType: "html",
			data:{index:i},
			success: function(data){
				
				//alert (data);
				//$('#main_content').html(data);
					$('div#app_page').html(data);
					$( "#tabs" ).tabs();
					
					get_comment();
					
						
							$('div#vote').raty({
									
								readOnly : false,	
								click : function(score,evt){
									
									
								$.ajax({
										type: "POST",
										url: "vote.php",
										dataType: "html",
										data: {score:score},
										success: function(data){
											alert (data);
											//$('#main_content').html(data);		
											}
										});
									},
									
									mouseover:function(score,evt){
										$('#vote_text').text(score);
									}
								
								});
					//$('div.l1').mousemove(function(){
						//$('div#move_app_index').toggle('fast');
					
					
					//});
					
					$('#tabs').css("height","100%");
					$('div#app_page').fadeIn('fast');
						//alert (data);
					$('td.app_bg').click(function(){
						//alert (data);
					$('div#app_page').fadeOut('fast');
					$('div#app_page').html('');

					});
				}
			});
		}
		
		
		
		
	function get_app2(i){
		//alert (i);
		
		$.ajax({
			type: "POST",
			url: "app2.php",
			dataType: "html",
			data:{index:i},
			success: function(data){
				
				//alert (data);
				//$('#main_content').html(data);
					$('div#app_page').html(data);
					$( "#tabs" ).tabs();
					
					get_comment();
							$('div#vote').raty({
								
								readOnly : false,	
								click : function(score,evt){
									
									
								$.ajax({
										type: "POST",
										url: "vote.php",
										dataType: "html",
										data: {score:score},
										success: function(data){
											alert (data);
											//$('#main_content').html(data);		
											}
										});
									},
									
									mouseover:function(score,evt){
										$('#vote_text').text(score);
									}
								
								});
					//$('div.l1').mousemove(function(){
						//$('div#move_app_index').toggle('fast');
					
					
					//});
					
					$('#tabs').css("height","100%");
					$('div#app_page').fadeIn('fast');
						//alert (data);
					$('td.app_bg').click(function(){
						//alert (data);
					$('div#app_page').fadeOut('fast');
					$('div#app_page').html('');

					});
				}
			});
		}
		
		
	function get_app3(i){
		//alert (i);
		
		$.ajax({
			type: "POST",
			url: "app3.php",
			dataType: "html",
			data:{index:i},
			success: function(data){
				
				//alert (data);
				//$('#main_content').html(data);
					$('div#app_page').html(data);
					$( "#tabs" ).tabs();
					
					get_comment();
							$('div#vote').raty({
								
								readOnly : false,	
								click : function(score,evt){
									
									
								$.ajax({
										type: "POST",
										url: "vote.php",
										dataType: "html",
										data: {score:score},
										success: function(data){
											alert (data);
											//$('#main_content').html(data);		
											}
										});
									},
									
									mouseover:function(score,evt){
										$('#vote_text').text(score);
									}
								
								});
					//$('div.l1').mousemove(function(){
						//$('div#move_app_index').toggle('fast');
					
					
					//});
					
					$('#tabs').css("height","100%");
					$('div#app_page').fadeIn('fast');
						//alert (data);
					$('td.app_bg').click(function(){
						//alert (data);
					$('div#app_page').fadeOut('fast');
					$('div#app_page').html('');

					});
				}
			});
		}
	
	/*-----------------COMMENT--------------------*/
	
	function comment(){
		
		$('#textbox_com').val();
		//alert ($('#textbox_com').val());
				
		$.ajax({
			type: "POST",
			url: "comment.php",
			dataType: "html",
			data: {comment : $('#textbox_com').val()},
			success: function(data){
				$('#textbox_com').val('');
				//alert (data);
				//$('#main_content').html(data);
					$.ajax({
						type: "POST",
						url: "get_comment.php",
						dataType: "html",
						success: function(data){
								$('u.comment_show').html(data);
								$('div#voted').each(function(){
										var score = $(this).attr("score");
										if(score > 0){
											$(this).raty({
												readOnly : true,
												score : score
											});	
										}
								});
								}
					}); 
			}
		}); 
	}
	
	
	
	
	function get_all_comment(){
		
		
		$.ajax({
			type: "POST",
			url: "get_show_all_comment.php",
			dataType: "html",
			success: function(data){
				//alert (data);
				//$('#main_content').html(data);
				$('u.comment_show').html(data);
				$('div#voted').each(function(){
						var score = $(this).attr("score");
						if(score > 0){
							$(this).raty({
								readOnly : true,
								score : score
						    });	
						}
				});		
			}
		}); 
	}
	
	function get_comment(){
		
		
		$.ajax({
			type: "POST",
			url: "get_comment.php",
			dataType: "html",
			success: function(data){
				//alert (data);
				//$('#main_content').html(data);
				$('u.comment_show').html(data);
				$('div#voted').each(function(){
						var score = $(this).attr("score");
						if(score > 0){
							$(this).raty({
								readOnly : true,
								score : score
						    });	
						}
				});		
			}
		}); 
	}
	
	
	
	
	/*function com_login(){
		
		$.ajax({
			type: "post",
			url: "show_box_com_login.php",
			dataType: "html",
			success: function(data){
				//alert ($('#main_content').html());
				$('#comment_warper').html(data);
				
			}
		});
		
	}*/
	
	
	
	/*--------------END---COMMENT----------------*/
	
	
	
	/*---------------PM----------------*/
	
	
	function get_pm(){
	
		$.ajax({
			
			type: "post",
			url: "pm_form.php",
			dataType: "html",
			success: function(data){
				//alert ($('#main_content').html());
				$('#main_content').html(data);
			}
		});
		
	}
	function send_pm(){
		var form = new FormData(document.getElementById("pm_box"));
		$.ajax({
			data: form,
			type: "post",
			processData: false, // tell jquery not to process data
			contentType: false, // tel jquery not to set contenttype
			url: "pm_update.php",
			dataType: "text",
			success: function(data){
				//alert ($('#main_content').html());
				//$('#main_content').html(data);
				alert (data);
				if(data == "ทำการส่งข้อความเรียบร้อย"){
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
	function load_pm(){
	
		$.ajax({
			
			type: "post",
			url: "pm_show.php",
			dataType: "html",
			success: function(data){
				//alert ($('#main_content').html());
				$('#main_content').html(data);
				
				$.ajax({
						type: "post",
						url: "get_pm.php",
						dataType: "html",
						success: function(data){
							//alert ($('#main_content').html());
							$('#pm_show1').html(data);
						}
					});
			}
		});
		
	}
	
	function get_delete_pm(num){
	
		$.ajax({
			
			type: "post",
			data: {id:num},
			url: "get_delete_pm.php",
			dataType: "html",
			success: function(data){
				//alert ($('#main_content').html());
				//$('#main_content').html(data);
				alert(data);
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
	
	
		function get_re_pm(num){
		
			
		$.ajax({
			
			type: "post",
			data: {id:num},
			url: "get_re_pm.php",
			dataType: "html",
			success: function(data){
				//alert ($('#main_content').html());
				$('#main_content').html(data);
				//alert(data);
				
			}
		});
		
	}
	
	
	/*--------------END---PM---------------*/
	