<html>
<head>
<style>
		u.pm_show , u.pm_text{
			width:500px;
			height:100px;
			display:inline-block;
			}
		u.pm_text li{
			width: 100%;
			height: auto;
			background-color: rgb(237 , 239 ,244);
			list-style-type:none;
			margin-top:1;
			border-top: 1px solid white;
			border-bottom: 1px solid rgb(201 , 217 , 231);
			display:inline-block;
		}
		
		u.pm_show li{
			width: 100%;
			height: auto;
			background-color: rgb(237 , 239 ,244);
			list-style-type:none;
			margin-top:1;
			border-top: 1px solid white;
			border-bottom: 1px solid rgb(201 , 217 , 231);
			display:inline-block;
		}
		
		.user_com , .vote_com{
			margin-right:50px;
			width:auto;
			float:left;
			}
			
		.pm_com{
			width: 100%;
			height: auto;
			float:left;			
			}
			
		.date_com{
			width:auto;
			float:right;
			text-align:right;
			}
			
		
		#textbox_com{
			width:100px;
			resize:none;
			overflow-x: wrap;
			}
		.pm_box{
			overflow:hidden;			
			}
			
		#pm{
			width: 100%;
			height: 100%;
			}
</style>
</head>
<body>
        <div id="pm">
            <u class="pm_text">
                <li>
                    <div class="pm_box">
                        <textarea type="text" id="textbox_com" placeholder="write a pm"></textarea>
                        <input type="button" value="pm" />
                    </div>
                </li>
                
            </u>
 
        </div>
        
          	<div id="tabs">
                    <ul>
                        <li><a href="#box_pm">BOX PM</a></li>
                        <li><a href="#send_pm">SEND</a></li>
                    </ul>
                    
                    <div id="box_pm">
                        <p></p>
                    </div>
                    <div id="send_pm">
                        <p></p>
        	</div>


</body>
</html>

