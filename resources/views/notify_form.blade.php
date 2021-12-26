<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

        <title>ONEPAY Payment!</title>
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

                    <h1>ONEPAY Payment</h1>
                    @if($payment_callback)
                        <p>Payment Status: {{$payment_status['status_message']}}</p>
                    @endif
                     
                    <a href="/checkout" class="ml-1 underline">
                        GOTO ONEPAY Checkout
                    </a>

                </div>
            </div>


        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

        <script>
$('div.alert').not('.alert-important').delay(3000).fadeOut(350);
        </script>

    </body>
</html>