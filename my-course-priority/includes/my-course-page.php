



<div class="my-accordion">
    
    
    <div class="title-welcome">
        <div class="loader">
            <span>ב</span>
            <span>ר</span>
            <span>ו</span>
            <span>כ</span>
            <span>י</span>
            <span>ם </span>
            <span> </span>
            <span>ה</span>
            <span>ב</span>
            <span>א</span>
            <span>י</span>
            <span>ם</span>
        </div>
        <h2 class="my-course">לקורס תכנות בפריוריטי</h2>
        <p class="course-description">
            הקורס שלפניכם הינו הקורס הוירטואלי הראשון מסוגו להכשרת מתכנתי פריוריטי.<br>
            הקורס כולל הסברים דוגמאות ותרגילים, לכל כלי הפיתוח העיקריים בפריוריטי.<br>
            הקורס עובד צמוד ל SDK צעד אחרי צעד.<br>
            הקורס מתאים לבעלי רקע יישומי בפריוריטי אשר רכשו רקע בסיסי בבסיסי נתונים ו SQL.  <br>
        </p>
    </div>
<?php
//check if the user buy the course and check the date
$user_open=false;
if(is_user_logged_in()) {
    $user_id = get_current_user_id(); // קבלת מזהה המשתמש הנוכחי
    $current_user = wp_get_current_user();
    $user_firstname = $current_user->user_firstname; // שם פרטי של המשתמש
    // השליפה של הערך של שדה מותאם אישית למשתמש
    $maslul_name = get_user_meta($user_id, 'maslul-name', true);
    $date_finish = get_user_meta($user_id, 'date-finish', true);
    $today_date = date("d/m/y");
    $formatted_date = date_i18n( 'd/m/Y', strtotime($date_finish) );
    if($date_finish && $maslul_name){
        if (strtotime($today_date) < strtotime($date_finish)) {
            $user_open = true;
        }
    }
}

//get all the lessons

    $args = array(
    'post_type' => 'lessons', // assuming 'lesson' is the custom post type name
    'posts_per_page' => -1, // -1 to fetch all posts
    );

    $query = new WP_Query( $args );

    // The Loop



    ?>
    <div class="list-lessons">
        <?php if($user_open==true){?>
        <div>
            <p class="helo-note"><?php echo $user_firstname; ?> שלום וברכה.  הנך מצורף ל <?php echo $maslul_name; ?> , הקורס זמין עבורך עד לתאריך <?php echo $formatted_date; ?>.</p>
        </div>
        <?php } ?>

      <?php
      if ( $query->have_posts() ) {
            while ( $query->have_posts() ) {

                $query->the_post();
                $post_id = get_the_ID();
                $summary=get_field('summary');
                $exercises=get_field('exercises');
                $solution= get_field('solution');
                $more_notes=get_field('more_notes');
                $play=get_field('play_lesson');

        ?>

        <!-- Chapter 1 -->

        <div id="<?php echo $post_id; ?>" class="single-lesson-wraper" data-toggle="collapse" data-target="#chapter1">
            <?php if($play=='0' && $user_open == false){?>
                <div class="title-and-arrow-not-play display-popup">
                    <img class="icon-play" src="<?php echo plugins_url('my-course-priority/includes/img/not-play.png')?>" aria-hidden="false" alt="">
                    <h2 class="title-of-lesson"> <?php the_title(); ?></h2>
                </div>
            <?php } else {?>
                <div class="title-and-arrow">
                        <img class="icon-play" src="<?php echo plugins_url('my-course-priority/includes/img/play.png')?>" aria-hidden="false" alt="">
                        <h2 class="title-of-lesson"> <?php the_title(); ?></h2>
                </div>

            <?php } ?>

            <div class="container-lesson">
                <div class="content-of-lesson">
                    <div class="video-and-content">
                        <div class="col-1">
                            <div class="video-container">
                                <?php the_content(); ?>
        <!--                        <iframe width="560" height="315" src="https://www.youtube.com/embed/Q0OCo5CEu4g?si=SOG6PUleL6ajVCtF" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>-->
                            </div>
                        </div>
                        <div class="col-2">

                            <div class="summary"><?php echo $summary; ?> </div>
                            <div class="buttons-exercises-and-solution">
                                <button class="exercises active">תרגילים:</button>
                                <button class="solution">פתרונות:</button>
                                <?php if($more_notes){ ?>
                                    <button class="more_notes">הרחבה:</button>
                                <?php } ?>

                            </div>
                            <div class="exercises" >
                                <p><?php echo  $exercises ?>
                                </p>
                            </div>
                            <div class="solution" >
                                <p><?php echo  $solution ?>
                                </p>
                            </div>
                            <div class="more_notes" >
                                <p><?php echo  $more_notes ?>
                                </p>
                            </div>
                            <div class="col-3">
<!--                                <a class="button" href="--><?php //echo get_permalink(); ?><!--"   target="_blank">לצפיה בפתרון התרגיל<img class="arrow-left" src="--><?php //echo plugins_url('my-course-priority/includes/img/arrow-up-square.svg')?><!--" aria-hidden="false" alt="">-->
<!--                                    </a>-->
                                <div class="button-to-comment" target="_blank" >נשמח לשיתוף הפיתרון שלכם! לשאלות ותגובות על השיעור <img class="arrow-left" src="<?php echo plugins_url('my-course-priority/includes/img/left-arrow.png')?>" aria-hidden="false" alt=""></div>

                            </div>
                        </div>
                    </div>
                    <div class="mylessonComments">

                        <!-- הצגת התגובות -->
                        <div class="comments-section">
                            <?php
                            $post_id = get_the_ID();
                            // הצגת תגובות בצורת עץ
                            $comments_args = array(
                                'walker'            => null,
                                'max_depth'         => '20',
                                'style'             => 'ul',
                                'callback'          => '',
                                'end-callback'      => null,
                                'type'              => 'all',
                                'reply_text'        => '',
                                'page'              => $post_id,
                                'per_page'          => '',
                                'avatar_size'       => 32,
                                'reverse_top_level' => null,
                                'reverse_children'  => false,
                                'format'            => 'html5',
                                'short_ping'        => false,
                                'echo'              => true,  // שים לב לשורה זו - השתנה ל-false
                            );

                            $comments = wp_list_comments($comments_args);

                            // קוד להצגת התגובות
                            echo $comments;

                            if ( $user_open==false ){ ?>
                                <button class="log-in-comment display-popup"> רוצה להשאיר תגובה? </button>

                            <?php }
                            else{
                                comment_form(array(
                                    'title_reply' => 'השאר תגובה', // כותרת כאשר משתמשים רוצים להשאיר תגובה
                                    'comment_notes_after' => '', // מסר לאחר הטופס (ברירת מחדל שמעביר לדף הפוסט)
                                ));
                            }

                            echo '<a href="#'. $post_id .'" class="scroll-to-lesson">חזרה לשיעור</a>'; // לינק לתגובות
                            ?>
                        </div>



                    </div>

                </div>
            </div>

        </div>
       <?php  }  } ?>
        <!-- Continue adding more chapters -->
<?php wp_reset_postdata(); ?>
    </div>

<!--end of accordion-->

<!--    --------------------------->

<!--popup to register-->

    <div class="show">
        <div class="overlay"></div>
        <div class="img-show">
            <span>X</span>
            <div>
                <p>
                    מעוניין בגישה לשיעורים נוספים?</br>
                    הרשם לאחד מהמסלולים שלנו </br> וקבל גישה לקורס המלא!
                </p>
                <a target="_blank" href="<?php echo  get_site_url() ?>/shop-course">מסלולים הרשמה
                    <img class="arrow-left" src="<?php echo plugins_url('my-course-priority/includes/img/arrow-left.svg')?>" aria-hidden="false" alt="">
                </a>
            </div>
        </div>
    </div>

</div>
</div>


<!--function to print the comments-->
<?php
function display_comment_tree($comment) {
    ?>
    <li>
        <?php echo $comment->comment_content; ?>
        <?php
        $child_comments = get_comments(array(
            'post_id' => $comment->comment_post_ID,
            'parent' => $comment->comment_ID
        ));
        if ($child_comments) {
            echo '<ul>';
            foreach ($child_comments as $child_comment) {
                display_comment_tree($child_comment);
            }
            echo '</ul>';
        }
        ?>
    </li>
    <?php
}


?>