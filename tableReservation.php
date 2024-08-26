<?php 

    include 'includes/header.php';
    include 'app/classes/TableReservation.php';

    if(isset($_POST['submit'])) {

        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $people = $_POST['people'];
        $date = $_POST['date'];
        $time = $_POST['time'];
        $message = $_POST['message'];
        $status = $_POST['status'];

        $reservation = new TableReservation($conn);
        $new_reservation = $reservation->create($name, $email, $phone, $people, $date, $time, $message, $status);

        $_SESSION['TableReserved'] = '
        <div class="messageConatainerHome flex">
            <span class="messageCard">
                <img src="./public/images/checkIcon.png" class="checkIconHome">
                <small>Table Resereved successfully! <br>So glad to serve you!</small>
            <br><br>
            - Thank you! -

            </span>
        </div>';
        header('location:' .ROOT_URL);
      exit();
    }
?>

    <!-- Table Section -->
    <section class="container section tableReservationPage">
    <div class="secContent">
        <div class="sectionIntro">
            <h1 class="secTitle">Table Reservation</h1>
            <p class="subTitle">Welcome to our chefs' listing.</p>

            <img src="<?=ROOT_URL?>public/images/titleDesign.png" alt="Design Image">
        </div>

        <div class="tabelReservation grid">
            <div class="imgDiv flex">
                <h3>Hey, we have a table for you!</h3>
                <p class="description">Let us prepare for your family and friends!</p>
            </div>
            <div class="formDiv">
                <form action="" method="POST">
                    <div class="formRow">
                    <label for="name">First Name</label>
                    <input type="text" name="name" id="name" placeholder="Enter your first name" required>
                    </div>
                    <div class="formRow">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="Enter your email" required>
                    </div>
                    <div class="formRow">
                    <label for="phone">Phone Number</label>
                    <input type="text" name="phone" id="phone" placeholder="Enter your phone number" required>
                    </div>
                    <div class="formRow">
                    <label for="tl">Number of people</label>
                    <input type="number" name="people" id="tl" value="1"  required>
                    </div>
                    <div class="formRow formRowFlex flex">
                    <div>
                    <label for="date_time">Date and time</label>
                    <input type="date" name="date" id="date"  required>
                    </div>
                    <div>
                    <label for="date_time">Date and time</label>
                    <input type="time" name="time" id="time"  required>
                    </div>
                    </div>
                    <div class="formRow">
                    <label for="message">Message</label>
                    <textarea name="message" id="message" placeholder="Leave us some message!"></textarea>
                    </div>
                    <div class="formRow"> 
                    <input type="hidden" name="status" value="reserved">
                    <input type="submit" name="submit" value="Reserve It" class="submitBtn">
                    </div>
    
                </form>
                <div class="contactNumber">
                    <small>Or</small>
                    <span class="phoneNumber flex">
                        <i class='bx bxs-phone-call icon'></i>
                        +444 000 000 000
                    </span>
                    <p>Mobile service availble 24/7</p>
                </div>
            </div>
        </div>
    </div>
    </section>
    <!-- Table Section Ends -->

<?php include 'includes/footer.php'; ?>