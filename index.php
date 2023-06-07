<?php
include 'connect.php';

if(isset($_POST['submit'])){
   $id = create_unique_id();
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $password = sha1($_POST['password']);
   $password = filter_var($password, FILTER_SANITIZE_STRING);
   $confirm_password = sha1($_POST['confirm_password']);
   $confirm_password = filter_var($confirm_password, FILTER_SANITIZE_STRING);
   $select_users = $conn->prepare("SELECT * FROM `sign_up` WHERE email = ?");
   $select_users->execute([$email]);

   if($select_users->rowCount() > 0){
      $warning_msg[] = 'email already taken!';
   }else{
      if($password != $confirm_password){
         $warning_msg[] = 'Password not matched!';
      }else{
         $insert_user = $conn->prepare("INSERT INTO `sign_up`(id, name, number, email, password) VALUES(?,?,?,?,?)");
         $insert_user->execute([$id, $name, $number, $email, $confirm_password]);
         if($insert_user){
            $verify_users = $conn->prepare("SELECT * FROM `sign_up` WHERE email = ? AND password = ? LIMIT 1");
            $verify_users->execute([$email, $password]);
            $row = $verify_users->fetch(PDO::FETCH_ASSOC);

         }
      }
   }
}
if(isset($_POST['send'])){
  $message_id=create_unique_id();
  $receiver="Josh Randor";
  $name=$_POST['name'];
  $name=filter_var($name, FILTER_SANITIZE_STRING);
  $email=$_POST['email'];
  $email=filter_var($email, FILTER_SANITIZE_STRING);
  $text=$_POST['text'];
  $text=filter_var($text, FILTER_SANITIZE_STRING);
  $verify_message=$conn->prepare("SELECT * FROM `messages` WHERE receiver=? AND name=? AND email=? AND text=?");
  $verify_message->execute([$name, $receiver, $email, $text]);

  if($verify_message->rowCount()>0){
      $warning_msg[]="message already sent!";
  }else{
      $insert_message=$conn->prepare("INSERT INTO `messages`(id,receiver,name,email,text) VALUES (?,?,?,?,?)");
      $insert_message->execute([$message_id, $receiver, $name, $email, $text]);
      $success_msg[]='message sent successfully!';
  }

}
if(isset($_POST['send2'])){
  $message_id=create_unique_id();
  $receiver="Christina Pery";
  $name=$_POST['name'];
  $name=filter_var($name, FILTER_SANITIZE_STRING);
  $email=$_POST['email'];
  $email=filter_var($email, FILTER_SANITIZE_STRING);
  $text=$_POST['text'];
  $text=filter_var($text, FILTER_SANITIZE_STRING);
  $verify_message=$conn->prepare("SELECT * FROM `messages` WHERE receiver=? AND name=? AND email=? AND text=?");
  $verify_message->execute([$name, $receiver, $email, $text]);

  if($verify_message->rowCount()>0){
      $warning_msg[]="message already sent!";
  }else{
      $insert_message=$conn->prepare("INSERT INTO `messages`(id,receiver,name,email,text) VALUES (?,?,?,?,?)");
      $insert_message->execute([$message_id, $receiver, $name, $email, $text]);
      $success_msg[]='message sent successfully!';
  }

}
if(isset($_POST['send3'])){
  $message_id=create_unique_id();
  $receiver="Adam Smith";
  $name=$_POST['name'];
  $name=filter_var($name, FILTER_SANITIZE_STRING);
  $email=$_POST['email'];
  $email=filter_var($email, FILTER_SANITIZE_STRING);
  $text=$_POST['text'];
  $text=filter_var($text, FILTER_SANITIZE_STRING);
  $verify_message=$conn->prepare("SELECT * FROM `messages` WHERE receiver=? AND name=? AND email=? AND text=?");
  $verify_message->execute([$name, $receiver, $email, $text]);

  if($verify_message->rowCount()>0){
      $warning_msg[]="message already sent!";
  }else{
      $insert_message=$conn->prepare("INSERT INTO `messages`(id,receiver,name,email,text) VALUES (?,?,?,?,?)");
      $insert_message->execute([$message_id, $receiver, $name, $email, $text]);
      $success_msg[]='message sent successfully!';
  }

}
if(isset($_POST['send4'])){
  $message_id=create_unique_id();
  $receiver="Blessy Mathew";
  $name=$_POST['name'];
  $name=filter_var($name, FILTER_SANITIZE_STRING);
  $email=$_POST['email'];
  $email=filter_var($email, FILTER_SANITIZE_STRING);
  $text=$_POST['text'];
  $text=filter_var($text, FILTER_SANITIZE_STRING);
  $verify_message=$conn->prepare("SELECT * FROM `messages` WHERE receiver=? AND name=? AND email=? AND text=?");
  $verify_message->execute([$name, $receiver, $email, $text]);

  if($verify_message->rowCount()>0){
      $warning_msg[]="message already sent!";
  }else{
      $insert_message=$conn->prepare("INSERT INTO `messages`(id,receiver,name,email,text) VALUES (?,?,?,?,?)");
      $insert_message->execute([$message_id, $receiver, $name, $email, $text]);
      $success_msg[]='message sent successfully!';
  }

}

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Body Club</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Hind+Madurai:wght@300;400;500;700;800&family=Inter:wght@300;400;500;700&family=Montserrat:wght@300;400;500;700&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500;700&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
    />
    <link rel="stylesheet" href="./src/styles/index.css" />
  </head>
  <body>
  <div id="menu-btn" class="fas fa-bars" onclick="openmenu()"></div>
    <header class="header">
      <nav class="header__nav">
        <a href="#nutrition" class="header__item">nutrition</a>
        <a href="#workouts" class="header__item">workouts</a>
        <a href="#offers" class="header__item">offers</a>
        <a href="#" class="button-primary nav-button" onclick="openForm()"
          >sign in</a
        >
      </nav>
    </header>

    <section class="menu" id=menu>
      <div id="close-btn"><i class="fas fa-times" onclick="closemenu()"></i></div>
      <a href="dashboard.php" class="logo">The Body Club</a>
      <nav class="navbar">
          <a class="menu__link" href="#home-page"><i class="fas fa-home"></i><span>home page</span></a>
          <a class="menu__link" href="#description"><i class="fa-solid fa-paperclip"></i><span>description</span></a>
          <a class="menu__link" href="#workouts"><i class="fa-solid fa-dumbbell"></i><span>workouts</span></a>
          <a class="menu__link" href="#offers"><i class="fa-solid fa-money-bill"></i><span>offers</span></a>
          <a class="menu__link" href="#nutrition"><i class="fa-solid fa-bowl-food"></i><span>recipes</span></a>
          <a class="menu__link" href="#experts"><i class="fa-solid fa-users"></i><span>experts</span></a>
          <a class="menu__link" href="#tools"><i class="fa-solid fa-gear"></i><span>tools</span></a>
          <a class="menu__link" href="#reviews"><i class="fa-solid fa-square-poll-vertical"></i><span>reviews</span></a>
          <a class="menu__link" href="#faq"><i class="fa-solid fa-question"></i><span>home</span></a>
          <a class="menu__link" href="#info"><i class="fa-sharp fa-solid fa-circle-info"></i><span>info</span></a>
      </nav>
    </section>

    <section class="home-page" id="home-page">
      <div class="home-page__title title">
        <p class="title__item">the</p>
        <p class="title__item">body</p>
        <p class="title__item">club</p>
      </div>
      <div class="form-popup" id="myForm">
        <form action="" class="form-container" method="post">
          <h1 class="form_title">Register</h1>
          <input
            type="tel"
            name="name"
            required
            maxlength="50"
            placeholder="enter your name"
            class="form_input"
          />
          <input
            type="email"
            name="email"
            required
            maxlength="50"
            placeholder="enter your email"
            class="form_input"
          />
          <input
            type="number"
            name="number"
            required
            minlength="10"
            maxlength="10"
            placeholder="enter your number"
            class="form_input"
          />
          <input
            type="password"
            name="password"
            required
            maxlength="20"
            placeholder="enter your password"
            class="form_input"
          />
          <input
            type="password"
            name="confirm_password"
            required
            maxlength="20"
            placeholder="enter your password"
            class="form_input"
          />

          <button type="submit" name="submit" class="button-primary home-page_btn">
            Register
          </button>
          <button type="button" class="button-primary home-page_btn cancel" onclick="closeForm()">
            Close
          </button>
        </form>
      </div>
      <div class="home-page__text">
        <p>give your body the love it deserves.</p>
        <a class="button-primary book-button" href="#">book appointment</a>
      </div>
    </section>
    <section class="description" id="description">
      <div class="description__title title">
        <h2><b>t</b>he <b>b</b>ody <b>c</b>lub</h2>
      </div>
      <div class="description__pre-container">
        <p class="description__text">
          THE BODY CLUB is your one stop destination, where we offer a variety
          of options to help you achieve your fitness goals. Our classes are
          designed to cater to all levels of experience, from beginner to
          advanced, and are led by certified and experienced instructors who are
          dedicated to helping you improve your overall well-being.
        </p>
        <img
          class="description__image"
          src="./src/public/dumbell.jpg"
          alt="dumbell"
        />
      </div>
      <div class="description__container">
        <img
          class="description__image"
          src="./src/public/headphones1.png"
          alt="dumbell"
        />
        <p class="description__text">
          Our studio is equipped with the latest equipment and technology to
          ensure that you have everything you need for a safe and effective
          workout. So whether you're looking to improve your flexibility, build
          strength, or simply de-stress and unwind, our Yoga and Workout Class
          has something for everyone. Come join us and start your journey
          towards a healthier, happier you!
        </p>
      </div>
    </section>
    <section class="courses" id="workouts">
      <div class="courses__container">
        <img
          class="courses__image"
          src="./src/public/meditation.jpg"
          alt="meditation"
        />
        <div class="courses__info">
          <h2 class="courses__title">meditation</h2>
          <p class="courses__text">
            Meditation is a practice that involves training your attention and
            awareness to achieve a calm and clear state of mind. Through regular
            meditation, you can reduce stress, improve focus and concentration,
            enhance emotional well-being, and promote overall mental and
            physical health.
          </p>
        </div>
      </div>
      <div class="courses__container">
        <img
          class="courses__image"
          src="./src/public/extreme_workout.jpg"
          alt="extreme_workout"
        />
        <div class="courses__info">
          <h2 class="courses__title">extreme workout</h2>
          <p class="courses__text">
            Intense workouts can have a variety of benefits, including improving
            cardiovascular health, increasing muscle strength and endurance, and
            boosting metabolism for increased calorie burn. They can also
            provide a sense of accomplishment and improve overall mood and
            energy levels. It's important to note that intense workouts are not
            suitable for everyone, particularly those with certain health
            conditions or who are new to exercise.
          </p>
        </div>
      </div>
      <div class="courses__container">
        <img
          class="courses__image"
          src="./src/public/splits.jpg"
          alt="splits"
        />
        <div class="courses__info">
          <h2 class="courses__title">splits</h2>
          <p class="courses__text">
            Splits is a stretching exercise that involves extending the legs in
            opposite directions until the hips are fully open and the legs are
            parallel to the floor. There are two main types of splits: the front
            split, where one leg is extended forward and the other leg is
            extended backward, and the side split, where both legs are extended
            to the sides.
          </p>
        </div>
      </div>
      <div class="courses__container">
        <img
          class="courses__image"
          src="./src/public/ballet.jpg"
          alt="ballet"
        />
        <div class="courses__info">
          <h2 class="courses__title">ballet</h2>
          <p class="courses__text">
            Ballet is a highly technical dance form that originated in the royal
            courts of Italy during the Renaissance and later developed into a
            highly structured and rigorous form in France and Russia. Ballet
            requires a great deal of discipline, focus, and physical strength
            and flexibility, and it typically involves precise and fluid
            movements of the body, often accompanied by music.
          </p>
        </div>
      </div>
      <div class="courses__container">
        <img
          class="courses__image"
          src="./src/public/maternal_yoga.jpg"
          alt="maternal_yoga"
        />
        <div class="courses__info">
          <span class="courses__title">maternal yoga</span>
          <p class="courses__text">
            Our Maternal Yoga classes are designed specifically for expectant
            mothers, with a focus on improving flexibility, balance, and
            strengthening the muscles required during childbirth. The class also
            includes breathing techniques to help calm the mind and prepare for
            labor.
          </p>
        </div>
      </div>
      <div class="courses__container">
        <img
          class="courses__image"
          src="./src/public/advanced_yoga.jpg"
          alt="advanced_yoga"
        />
        <div class="courses__info">
          <span class="courses__title">advanced yoga</span>
          <p class="courses__text">
            Advanced yoga is a practice that builds upon the foundation of
            traditional yoga, including postures (asanas), breathing exercises
            (pranayama), and meditation. It requires a deep understanding and
            experience of the principles and techniques of yoga, as well as a
            strong commitment to ongoing practice and study.
          </p>
        </div>
      </div>
    </section>
    <section class="plans" id="offers">
      <h2 class="plans__title">our plans</h2>
      <p class="plans__text">
        GET TO KNOW US FOR FREE WITH OUR 15-DAY TRIAL PLAN AND JOIN OUR
        COMMUNITY FOR DAILY UPDATES AND KNOW PEOPLE’S HEALHTY JOURNEY WITH US.
      </p>
      <div class="plans__container">
        <div class="plans__card">
          <p class="plans__name">free membership</p>
          <p class="plans__price">$ 0</p>
          <p class="plans__duration">&nbsp;</p>
          <a href="#" class="plans__btn">get started</a>
        </div>
        <div class="plans__card">
          <p class="plans__name">annual membership</p>
          <p class="plans__price">$15/month</p>
          <p class="plans__duration">Billed yearly</p>
          <a href="#" class="plans__btn">buy now</a>
        </div>
        <div class="plans__card">
          <p class="plans__name">monthly membership</p>
          <p class="plans__price">$25/month</p>
          <p class="plans__duration">Billed monthly</p>
          <a href="#" class="plans__btn">buy now</a>
        </div>
      </div>
    </section>
    <section class="recipes" id="nutrition">
      <div class="recipes__container">
        <div class="meal-wrapper">
          <div class="meal-search">
            <h2 class="recipes__title">eat healthy and delicious</h2>
            <p class="recipes__text">
              with the perfect recipes by our health chef be it lunch, dinner,
              breakfast or keto, vegan as well as your favorite cheat day
              recipes we got you.
            </p>

            <form class="recipes__search-box">
              <input
                type="text"
                class="search-control"
                placeholder="Enter an ingredient"
                id="search_input"
                oninput="restrictToLetters(this)"
              />
              <button type="submit" class="search_btn" id="search_btn">
                <i class="fas fa-search"></i>
              </button>
            </form>
          </div>

          <div class="recipes__meal-result">
            <div id="error_message" class="recipes__meal-item hidden"></div>
            <div id="mealLists" class="recipes__meal-item hidden">
              <p>Sorry, we didn't find any meal!</p>
            </div>
            <h2 id="recipes__meal-title"></h2>
            <div id="recipes__card"></div>
          </div>
        </div>
      </div>
    </section>
    <section class="experts" id="experts">
      <h1 class="experts__title">meet the experts</h1>
      <div class="experts__container" id="container">
        <div class="experts__card">
          <img
            src="./src/public/expert1.png"
            class="experts__image"
            alt="expert Josh"
          />
          <div class="experts__card-container">
            <div id="experts__containing">
              <h3 class="experts__name">Josh Radnor</h3>
              <p class="experts__info">
                Hi. I am your fitness expert I have trained thousands of fitness
                freaks over the years.
              </p>
              <button type="button" class="button-primary btn-info"  id="btn_info" onclick="opensForm()">Send message</button>
            </div>
              <div class="form-popup" id="Form">
              <form action="" method="post" class="form-container form_odd">
                <h3>YOU WRITE MESSAGE TO:</h3>
                <input type="text" name="receiver" required maxlength="50" id="form_receiver"  value="Josh Randor" readonly required class="form_input form_receiver">
                <input type="text" name="name" required maxlength="50" placeholder="enter your name" class="form_input">
                <input type="email" name="email" required maxlength="50" placeholder="enter your email" class="form_input">
                <textarea name="text" placeholder="enter your message" required maxlength="1000" cols="30" rows="5" class="form_input"></textarea>
                <button type="submit" name="send" class="button-primary ">
                  Send
                </button>
                <button type="button" class="button-primary cancel" onclick="closesForm()">
                  Close
                </button>
              </form>
            </div>
          </div>
        </div>
        <div class="experts__card">
          <img
            src="./src/public/expert2.png"
            class="experts__image"
            alt="expert Christina"
          />
          <div class="experts__card-container">
            <div id="experts__containing2">
              <h3 class="experts__name">CHRISTINA PERY</h3>
              <p class="experts__info">
                Hello. I have my expertise in teaching advanced yoga and splits
                with 4 years of experience.
              </p>
              <button type="button" class="button-primary btn-info"  id="btn_info"onclick="opensForm2()">Send message</button>
          </div>
            <div class="form-popup" id="Form2">
              <form action="" method="post" class="form-container form_even">
                <h3>YOU WRITE MESSAGE TO:</h3>
                <input type="text" name="receiver" required maxlength="50" id="form_receiver"  value="Christina Pery" readonly required class="form_input form_receiver">
                <input type="text" name="name" required maxlength="50" placeholder="enter your name" class="form_input">
                <input type="email" name="email" required maxlength="50" placeholder="enter your email" class="form_input">
                <textarea name="text" placeholder="enter your message" required maxlength="1000" cols="30" rows="5" class="form_input"></textarea>
                <button type="submit" name="send2" class="button-primary ">
                  Send
                </button>
                <button type="button" class="button-primary  cancel" onclick="closesForm2()">
                  Close
                </button>
              </form>
            </div>
          </div>
        </div>
        <div class="experts__card">
          <img
            src="./src/public/expert3.png"
            class="experts__image"
            alt="expert Adam"
          />
          <div class="experts__card-container">
            <div id="experts__containing3">
              <h3 class="experts__name">ADAM SMITH</h3>
              <p class="experts__info">
                Bonjour. I have been training people for building muscle strength
                and fitness for around 8 years.
              </p>
              <button type="button" class="button-primary btn-info"  id="btn_info"onclick="opensForm3()">Send message</button>
            </div>
            <div class="form-popup" id="Form3">
              <form action="" method="post" class="form-container form_odd">
                <h3>YOU WRITE MESSAGE TO:</h3>
                <input type="text" name="receiver" required maxlength="50" id="form_receiver"  value="Adam Smith" readonly required class="form_input form_receiver">
                <input type="text" name="name" required maxlength="50" placeholder="enter your name" class="form_input">
                <input type="email" name="email" required maxlength="50" placeholder="enter your email" class="form_input">
                <textarea name="text" placeholder="enter your message" required maxlength="1000" cols="30" rows="5" class="form_input"></textarea>
                <button type="submit" name="send3" class="button-primary ">
                  Send
                </button>
                <button type="button" class="button-primary  cancel" onclick="closesForm3()">
                  Close
                </button>
              </form>
            </div>
          </div>
        </div>
        <div class="experts__card">
          <img
            src="./src/public/expert4.png"
            class="experts__image"
            alt="expert Blessy"
          />
          <div class="experts__card-container">
            <div id="experts__containing4">
              <h3 class="experts__name">BLESSY MATHEW</h3>
              <p class="experts__info">
                ALOS. This your favorite ballet teacher . I teach ballet from
                beginner to advanced level.
              </p>
              <button type="button" class="button-primary btn-info"  id="btn_info"onclick="opensForm4()">Send message</button>
            </div>
              <div class="form-popup" id="Form4">
              <form action="" method="post" class="form-container form_even">
                <h3>YOU WRITE MESSAGE TO:</h3>
                <input type="text" name="receiver" required maxlength="50" id="form_receiver"  value="Blessy Mathew" readonly required class="form_input form_receiver">
                <input type="text" name="name" required maxlength="50" placeholder="enter your name" class="form_input">
                <input type="email" name="email" required maxlength="50" placeholder="enter your email" class="form_input">
                <textarea name="text" placeholder="enter your message" required maxlength="1000" cols="30" rows="5" class="form_input"></textarea>
                <button type="submit" name="send4" class="button-primary ">
                  Send
                </button>
                <button type="button" class="button-primary  cancel" onclick="closesForm4()">
                  Close
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="tools" id="tools">
      <div class="tools__container">
        <div class="tools__tracker-first">
          <div class="tools__card calories">
            <h3 class="tools__name">TRACK YOUR COLORIES EXPENSES</h3>
            <img
              class="tools__image"
              src="./src/public/tool_1.png"
              alt="calories"
            />
            <img
              class="tools__image"
              src="./src/public/tool_2.png"
              alt="calories"
            />
          </div>

          <div class="tools__card sleep-water">
            <div class="tools__item">
              <h3 class="tools__item-name">SLEEP TRACKER</h3>
              <img
                class="tools__item-image"
                src="./src/public/tool_3.png"
                alt="sleep"
              />
            </div>
            <div class="tools__item">
              <h3 class="tools__item-name">WATER TRACKER</h3>
              <img
                class="tools__item-image"
                src="./src/public/tool_4.png"
                alt="water"
              />
            </div>
          </div>
        </div>

        <div class="tools__tracker-second">
          <h2 class="tools__title">BEST TOOLS FOR GREAT EXPERIENCE</h2>
          <div class="tools__main">
            <div class="tools__card workouts">
              <h3 class="tools__name">TRACK YOUR DAILY WORKOUTS</h3>
              <img
                class="tools__image-workout"
                src="./src/public/tool_5.png"
                alt="workout__image"
              />
            </div>
            <div class="tools__card music">
              <h3 class="tools__name">
                LISTEN TO FAVOURITE MUSIC WHILE EXERCISING
              </h3>
              <div class="music__container">
                <div class="music__listen">
                  <img
                    class="music__image"
                    src="./src/public/music.png"
                    alt="music_cover"
                  />
                  <div class="music__info">
                    <span class="music__name">Flowers</span>
                    <span class="music__author">Miley Cyrus</span>
                  </div>
                </div>
                <p class="line"></p>
                <audio controls class="music__miley">
                  <source
                    src="./src/public/Miley Cyrus - Flowers.mp3"
                    type="audio/mp3"
                  />
                </audio>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="reviews" id="reviews">
      <h2 class="reviews__title">reviews</h2>
      <p class="reviews__text">
        THE VALUEABLE SECTION WHICH MAKES US BETTER EVERYDAY
      </p>
      <div class="reviews__container">
        <div class="reviews__card">
          <img
            src="./src/public/reviewer1.png"
            class="reviewer__image"
            alt="reviewer_Carl"
          />
          <div class="reviewer__info">
            <h3 class="reviewer__name">CARL JOHN</h3>
            <p class="reviewer__text">
              With THE BODY CLUB app I have lost 10kg .By having a perfect body
              I have good concentration and motivation in life.
            </p>
          </div>
        </div>
        <div class="reviews__card">
          <img
            src="./src/public/reviewer2.png"
            class="reviewer__image"
            alt="reviewer_Alyssia"
          />
          <div class="reviewer__info">
            <h3 class="reviewer__name">ALYSSIA CARA</h3>
            <p class="reviewer__text">
              By learning ballet I have revived my culture into my kids. Thank
              you THE BODY CLUB mentors .
            </p>
          </div>
        </div>
      </div>
    </section>
    <section class="faq" id="faq">
      <h2 class="faq__title">FAQ`S</h2>
      <div class="faq__container">
        <div class="faq__item">
          <button class="faq__accordion">How does Yoga work?</button>
          <div class="panel">
            <p>
              Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
              eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut
              enim ad minim veniam, quis nostrud exercitation ullamco laboris
              nisi ut aliquip ex ea commodo consequat.
            </p>
          </div>
        </div>
        <div class="faq__item">
          <button class="faq__accordion">
            What are the health benefits of workouts ?
          </button>
          <div class="panel">
            <p>
              Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
              eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut
              enim ad minim veniam, quis nostrud exercitation ullamco laboris
              nisi ut aliquip ex ea commodo consequat.
            </p>
          </div>
        </div>
        <div class="faq__item">
          <button class="faq__accordion">
            How will Ballet help me flexible my body ?
          </button>
          <div class="panel">
            <p>
              Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
              eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut
              enim ad minim veniam, quis nostrud exercitation ullamco laboris
              nisi ut aliquip ex ea commodo consequat.
            </p>
          </div>
        </div>
        <div class="faq__item">
          <button class="faq__accordion">
            Is Yoga suitable for beginners?
          </button>
          <div class="panel">
            <p>
              Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
              eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut
              enim ad minim veniam, quis nostrud exercitation ullamco laboris
              nisi ut aliquip ex ea commodo consequat.
            </p>
          </div>
        </div>
        <div class="faq__item">
          <button class="faq__accordion">How does Yoga work?</button>
          <div class="panel">
            <p>
              Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
              eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut
              enim ad minim veniam, quis nostrud exercitation ullamco laboris
              nisi ut aliquip ex ea commodo consequat.
            </p>
          </div>
        </div>
        <div class="faq__item">
          <button class="faq__accordion">
            Are there any exercises for post-natal mother ?
          </button>
          <div class="panel">
            <p>
              Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
              eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut
              enim ad minim veniam, quis nostrud exercitation ullamco laboris
              nisi ut aliquip ex ea commodo consequat.
            </p>
          </div>
        </div>
      </div>
    </section>
    <footer class="footer" id="info">
      <div class="footer__first">
        <h2 class="footer__title"><b>t</b>he <b>b</b>ody <b>c</b>lub</h2>
        <h4 class="footer__name">Keep in Touch</h4>
        <p class="footer__text">
          Join our newsletter to receive exclusive recipes, discounts, new
          course updates, and more.
        </p>
        <form class="footer__input" action="send_mail.php" method="POST">
          <input type="email"  name="email" class="footer__email" placeholder="EMAIL" />
          <input type="text"  name="subject" class="footer__subject" placeholder="EMAIL" />
          <input type="text"  name="message" class="footer__message" placeholder="EMAIL" />
          <button type="submit" name="send" class="footer__btn" >send</button>
        </form>
      </div>
      <div class="footer__second">
        <div class="footer__link__first-column">
          <a href="#" class="footer__link">blogs</a>
          <a href="#" class="footer__link">security</a>
          <a href="#" class="footer__link">business</a>
          <a href="#" class="footer__link">team</a>
        </div>
        <div class="footer__link__second-column">
          <a href="#" class="footer__link">terms and conditions</a>
          <a href="#" class="footer__link">community</a>
          <a href="#" class="footer__link">careers</a>
          <a href="#" class="footer__link">contact us</a>
        </div>
      </div>
      <div class="footer__third">
        <div class="footer__download-container">
          <a class="footer__download" href="#"
            ><img
              class="footer__icon"
              src="./src/public/apple.png"
              alt="apple"
            />
            <span class="footer__download-text"
              >DOWNLOAD ON APPLE STORE</span
            ></a
          >
          <a class="footer__download" href="#">
            <img
              class="footer__icon"
              src="./src/public/google.png"
              alt="google"
            />
            <span class="footer__download-text">DOWNLOAD ON PLAY STORE</span>
          </a>
        </div>
        <div class="footer__sprites">
          <a href="#"
            ><img
              src="./src/public/twitter.png"
              alt="twitter"
              class="footer__sprites-image"
          /></a>
          <a href="#"
            ><img
              src="./src/public/instagram.png"
              alt="instagram"
              class="footer__sprites-image"
          /></a>
          <a href="#"
            ><img
              src="./src/public/facebook.png"
              alt="facebook"
              class="footer__sprites-image"
          /></a>
          <a href="#"
            ><img
              src="./src/public/youtube.png"
              alt="youtube"
              class="footer__sprites-image"
          /></a>
        </div>
      </div>
    </footer>

<script>
  function openmenu() {
    document.getElementById("menu").style.display = "block";
  }

  function closemenu() {
    document.getElementById("menu").style.display = "none";
  }
</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="javascript.js"></script>
    <?php include 'message.php';?>
    </body>
</html>
