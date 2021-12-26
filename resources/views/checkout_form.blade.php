<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

        <title>ONEPAY Checkout!</title>
    </head>
    <body>
        <div class="container">






            <div class="row justify-content-md-center pt-2">


                <div class="col-6">

                    @if (session('error'))
                    <div class="alert alert-warning">{{ session('error') }}</div>
                    @endif
                    
                    @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <h1>ONEPAY Checkout</h1>

                    <hr>

                    <form method="POST" action="{{ route('onepay.checkout-request') }}" id="onepay-checkout-form">
                        @csrf                
                        <div class="mb-3">
                            <label for="stuid" class="form-label">Student ID</label>
                            <input type="text" value="0004" class="form-control" id="stuid" placeholder="Student ID" required name="stuid">
                        </div>

                        <div class="mb-3">
                            <label for="firstname" class="form-label">Student First Name</label>
                            <input type="text" value="Thusitha" class="form-control" id="firstname" placeholder="Student firstname" required name="firstname">
                        </div>

                        <div class="mb-3">
                            <label for="lastname" class="form-label">Student Last Name</label>
                            <input type="text" value="Avinda" class="form-control" id="lastname" placeholder="Student Name" required name="lastname">
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Student Email</label>
                            <input type="email" value="thusithawijethunga@gmail.com" class="form-control" id="email" placeholder="Student email" name="email" required>
                        </div>

                        <div class="mb-3">
                            <label for="tele" class="form-label">Telephone Number</label>
                            <input type="tel" value="+94775802112" formmethod=""class="form-control" id="wh" placeholder="Whatsapp No (ex: +947xxxxxx)" name="tele" pattern="^(?:7|0|(?:\+94))[0-9]{9,10}$" required>
                        </div>

                        <div class="mb-3">
                            <label for="pay" class="form-label">Payment Amount</label>
                            <input type="text" value="195" step="0.01" class="form-control" name="pay" placeholder="Payment" min="0.00" max="10000.00" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Pay Now</button>
                    </form>

                </div>
            </div>


        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

        <script>
            $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
        </script>

    </body>
</html>