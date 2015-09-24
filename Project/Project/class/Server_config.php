<?php

			$config = array('127.0.0.1','root','1234','project');
			$min_garde = 45;
			$max_garde = 61;
			$head_admin = "x_01";
			
			
								//-----------APP-----------//
								
			$max_file_size = 200*1024*1024; //byte
			$allow_file_type_app = Array(	
											'',
											'application/octet-stream',
											'application/x-rar-compressed',
											'application/zip',
										);
										
								//---------------------------//
										//-----------DOCUMENT-----------//
								
			$max_file_doc_size = 200*1024*1024; //byte
			$allow_file_doc_type_app = Array(	
											'',
											'application/octet-stream',
											'application/x-rar-compressed',
											'application/zip',
										);
										
								//---------------------------//
								
								
								
								
								//-----------logo && scr------//
								
			$max_file_logo_size = 102400; //byte
			$allow_file_type_pic =Array(
											'',
											'image/png',
											'image/gif',
											'image/jpeg',
										);
										
								//---------------------------//
								
								
								
								
								
								//------------clip-------------//
								
			$max_clip_file_size = 1*1024*1024; //byte
			$allow_file_type_clip =Array(
											'',
											'image/png',
											'image/gif',
											'image/jpeg',
										);
										
								//---------------------------//
			
			$max_app_per_page = 30;
			
			$max_app_per_page_index = 10;
			
			$comment_show = 5;
			
			
?>