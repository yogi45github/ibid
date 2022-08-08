<?php 
	function mt_post_sharer(){

		$html = '';
		$html .= '<div class="article-social">
                        <h3>'.esc_attr('Share this post, choose your platform!', 'modeltheme').'</h3>
                        <ul class="social-shareer">
                            <li>
                                <a href="http://www.facebook.com/share.php?u='.get_permalink().'&amp;title='.get_the_title().'"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li>
                                <a href="http://twitter.com/home?status='.get_the_title().'+'.get_permalink().'"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li>
                                <a href="https://plus.google.com/share?url='.get_permalink().'"><i class="fa fa-google-plus"></i></a>
                            </li>
                            <li>
                                <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url='.get_permalink().'&amp;title='.get_the_title().'&amp;source='.get_permalink().'"><i class="fa fa-linkedin"></i></a>
                            </li>
                            <li>
                                <a href="http://www.reddit.com/submit?url='.get_permalink().'&amp;title='.get_the_title().'"><i class="fa fa-reddit"></i></a>
                            </li>
                            <li>
                                <a href="http://www.tumblr.com/share?v=3&amp;u='.get_permalink().'&amp;t='.get_the_title().'"><i class="fa fa-tumblr"></i></a>
                            </li>
                        </ul>
                    </div>';

        return $html;
	}
?>