<style>
    /* start form */

.from {
    width: 100%;
    height: auto;
    background-size: cover;
    text-align: center
}

.from h2 {
    color: #444;
    font-size: 36px;
    font-weight: bold;
    margin-bottom: 15px;
}

.from span {
    display: block;
    color: #444;
    font-size: 14px;
    margin-bottom: 15px;
}

.from>div {
    display: flex;
    flex-wrap: nowrap;
    width: 100%;
    justify-content: center;
    align-items: center;
    margin-bottom: 50px;
}

.from>div div:first-of-type {
    width: 28%;
    color: #444;
    font-size: 14px;
}

.from>div div:first-of-type svg {
    color: #00c9db;
    margin-right: 5px;
}

.from>div div:nth-of-type(2) {
    width: 14%;
    color: #444;
    font-size: 14px;
}

.from>div div:nth-of-type(2) a {
    color: #444;
}

.from>div div:nth-of-type(2) svg {
    color: #fff;
    margin-right: 5px;
}

.from>div div:last-of-type {
    width: 14%;
    color: #444;
    font-size: 14px;
}

.from>div div:last-of-type a {
    color: #444;
}

.from>div div:last-of-type svg {
    color: #fff;
    margin-right: 5px;
}

.from form {
    width: 45%;
    display: flex;
    flex-wrap: wrap;
    margin: auto;
    position: relative;
}

.from form label:first-of-type {
    position: absolute;
    top: 15px;
    left: 20px;
    font-weight: bold;
    font-size: 14px;
    color: #444;
    text-transform: capitalize;
    transition: .3s all linear;
}

.from form input:first-of-type {
    width: 100%;
    padding: 22px 0 10px 22px;
    background-color: #fff;
    color: #444;
    font-size: 15px;
    outline: none;
    border: .5px solid #ccc;
    border-radius: 5px;
    margin-bottom: 20px;
}

.from form label:nth-of-type(2) {
    position: absolute;
    top: 83.5px;
    left: 20px;
    font-weight: bold;
    font-size: 14px;
    color: #444;
    text-transform: capitalize;
    transition: .3s all linear;
}

.from form input:nth-of-type(2) {
    width: 100%;
    padding: 22px 0 10px 22px;
    background-color: #fff;
    color: #444;
    font-size: 15px;
    outline: none;
    border: .5px solid #ccc;
    border-radius: 5px;
    margin-bottom: 20px;
}

.from form label:nth-of-type(3) {
    position: absolute;
    top: 154.5px;
    left: 20px;
    font-weight: bold;
    font-size: 14px;
    color: #fff;
    text-transform: capitalize;
    transition: .3s all linear;
}

.from form textarea {
    width: 100%;
    height: 200px;
    padding: 22px 0 10px 22px;
    background-color: #fff;
    color: #444;
    font-size: 15px;
    outline: none;
    border: .5px solid #ccc;
    border-radius: 5px;
    margin-bottom: 20px;
}

.from form label:nth-of-type(4) {
    font-weight: bold;
    font-size: 11px;
    color: #888;
    text-transform: capitalize;
    display: inline-block;
}

.from form input:nth-of-type(3) {
    margin-right: 5px;
    display: inline-block;
    margin-bottom: 20px;
}

.from form button {
    width: 100%;
    padding: 12px;
    border-radius: 30px;
    color: #444;
    font-size: 12px;
    text-transform: uppercase;
    background-color: #f7f7f7;
    border: 2px solid #888;
    transition: .4s all linear;
}

.from form button:hover {
    color: #fff;
    background-color: #000;
    border: 1px solid #000;
}

.from form span {
    display: block;
    padding-bottom: 10px;
}

@media only screen and (max-width:426px) {
    .from {
        padding: 50px 10px;
    }
    .from>div {
        flex-wrap: wrap;
    }
    .from>div div:nth-of-type(2) {
        width: 100%;
        margin-bottom: 20px;
    }
    .from>div div:first-of-type {
        width: 100%;
        margin-bottom: 20px;
    }
    .from>div div:last-of-type {
        width: 100%;
    }
    .from form {
        width: 100%;
    }
    .from form input:nth-of-type(3) {
        width: 10%;
        margin: 0;
    }
    .from form label:nth-of-type(4) {
        width: 90%;
        margin-bottom: 30px;
    }
}

@media only screen and (min-width: 426px) {
    .from {
        padding: 50px 20px;
    }
    .from>div {
        flex-wrap: wrap;
    }
    .from>div div:nth-of-type(2) {
        width: 100%;
        margin-bottom: 20px;
    }
    .from>div div:first-of-type {
        width: 100%;
        margin-bottom: 20px;
    }
    .from>div div:last-of-type {
        width: 100%;
    }
    .from form {
        width: 100%;
    }
    .from form input:nth-of-type(3) {
        width: 10%;
        margin: 0;
    }
    .from form label:nth-of-type(4) {
        width: 90%;
        margin-bottom: 30px;
    }
}

@media only screen and (min-width: 600px) {
    .from {
        padding: 50px;
    }
    .from>div {
        flex-wrap: wrap;
    }
    .from>div div:nth-of-type(2) {
        width: 100%;
        margin-bottom: 20px;
    }
    .from>div div:first-of-type {
        width: 100%;
        margin-bottom: 20px;
    }
    .from>div div:last-of-type {
        width: 100%;
    }
    .from form {
        width: 100%;
    }
    .from form input:nth-of-type(3) {
        width: 10%;
        margin: 0;
    }
    .from form label:nth-of-type(4) {
        width: 90%;
        margin-bottom: 30px;
    }
}

@media only screen and (min-width: 768px) {
    .from {
        padding: 70px;
    }
    .from>div {
        flex-wrap: wrap;
    }
    .from>div div:nth-of-type(2) {
        width: 100%;
        margin-bottom: 20px;
    }
    .from>div div:first-of-type {
        width: 100%;
        margin-bottom: 20px;
    }
    .from>div div:last-of-type {
        width: 100%;
    }
    .from form {
        width: 100%;
    }
    .from form input:nth-of-type(3) {
        width: 10%;
        margin: 0;
    }
    .from form label:nth-of-type(4) {
        width: 90%;
        margin-bottom: 30px;
    }
}

@media only screen and (min-width: 992px) {
    .from {
        padding: 70px;
    }
    .from>div {
        flex-wrap: wrap;
    }
    .from>div div:nth-of-type(2) {
        width: 100%;
        margin-bottom: 20px;
    }
    .from>div div:first-of-type {
        width: 100%;
        margin-bottom: 20px;
    }
    .from>div div:last-of-type {
        width: 100%;
    }
    .from form {
        width: 70%;
    }
    .from form input:nth-of-type(3) {
        width: 10%;
        margin: 0;
    }
    .from form label:nth-of-type(4) {
        width: 90%;
        margin-bottom: 30px;
    }
}

@media only screen and (min-width: 1400px) {
    .from {
        padding: 70px;
    }
    .from>div {
        flex-wrap: wrap;
    }
    .from>div div:nth-of-type(2) {
        width: 100%;
        margin-bottom: 20px;
    }
    .from>div div:first-of-type {
        width: 100%;
        margin-bottom: 20px;
    }
    .from>div div:last-of-type {
        width: 100%;
    }
    .from form {
        width: 50%;
    }
    .from form input:nth-of-type(3) {
        width: 5%;
        margin: 0;
    }
    .from form label:nth-of-type(4) {
        width: 95%;
        margin-bottom: 30px;

    }
}
</style>
<footer id="footer">
    <div class="footer-widget">
        <div class="container">
            <div class="row">
                    <section class="from" id="contact">
                        <h2>
                            CONTACT
                        </h2>
                        <span>Don't hesitate to give us a call or just use the contact form below</span>
                        <div>
                            <div><i class="fas fa-map-marker-alt"></i> Pv21 condominium, Kuala Lumpur, Malaysia </div>
                            <div><i class="fas fa-phone"></i> <a href="#">+60 178464650</a></div>
                            <div><i class="fas fa-envelope"></i> <a href="#">Alomda.alslmat@gmail.com</a></div>
                        </div>
                        <form action="{{url('/page/sendcontactissue')}}" method="post">
                            @csrf
                            <label for="text" class="label">
                            </label>
                            <input type="text" required name="name" class="input" placeholder="Please Enter Your Name"
                                style="padding:10px;width:100%">
                            <label for="email" class="label">
                            </label>
                            <input type="email" name="email" required class="input" placeholder="Please Enter Your Email"
                                style="padding:10px;margin-bottom:15px;border-radius:5px ;border:1px solid #ccc ;width:100%">
                            <label for="textarea" class="label"></label>
                            <textarea name="message" id="textarea" cols="30" rows="10" required
                                placeholder="Please Type Your FeadBack Here" style="line-height: 30px"></textarea>
                            <button id="submit" type="submit">submit message</button>

                        </form>
                    </section>
                       @if ($message = Session::get('error'))
                        <div class="alert alert-danger alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                        @endif
                        @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                        @endif
                    <div class="single-widget" style="text-align: center">
                        <h2>Subscribe Via Email</h2>
                        <form action="javascript:void(0);" class="searchform" type="post">
                            @csrf
                            <input style="width: 50%" type="email" name="subscribe" id="subscribe"
                                placeholder="Enter Your Email To Subscribe" required />
                            <button type="submit" class="btn btn-dark checkEmail"><i
                                    class="fa fa-arrow-circle-o-right"></i></button>
                            <span style="margin-top: 20px" id="Message"></span>
                            <p>Get the most recent updates from <br />our site and be updated your self...</p>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <p class="pull-left">Copyright © 2020 <strong><span style="color: #c44">Abo</span>-Shopper
                    </strong> Inc. All rights reserved.</p>
                <p class="pull-right">Designed by <span><a target="_blank" href="#">Abo Kaesr</a></span></p>
            </div>
        </div>
    </div>

</footer>
<!--/Footer-->
