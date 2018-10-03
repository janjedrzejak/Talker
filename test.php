<?php
	$s = "@abcd efg";
	echo substr($s, 1, strpos($s, " "));
?>


if($user_name_my == $private_message_send_to_nick) {
							continue;
						}



						echo '
									<div class="answer_b">
										<div class="answer_b_text">
         								<span style="font-weight:bold;">wiadomość prywatna od '. $user_name . '</span><br>' . $message_content .'
                        				</div>
                        				<img src="' . $user_avatar . '" class="avatar answer_b_avatar">
									</div>
								';


								if(private_message($message_content) == true) {
							if(private_message_is_to_me($message_content)) {
								
							} //no jak nie do mnie to nie wyświetlaj
						} else {