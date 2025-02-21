Yes, you can trigger the controller's action from the frontend in Laravel while using the submit button with a spinner and processing text. You can either use a **standard form submission** or **AJAX** to submit the form to the controller.

Since you’re asking about using Laravel **controller** and submitting from the frontend, I'll explain both methods. Here are two options:

### Option 1: **Standard Form Submission (Traditional)**

In this case, you will keep the form submission traditional. You just show the spinner and processing text before the form is submitted to the controller.

#### Example:

Here’s how the code can be modified for traditional form submission:

1. **Blade View (Submit Button with Spinner and Processing Text)**

```blade
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Button with Spinner</title>

    <style>
        /* Style for the spinner */
        #spinner {
            display: none;
            border: 3px solid transparent;
            border-top: 3px solid #ffffff;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            animation: spin 1s linear infinite;
        }

        /* Keyframes for spinner animation */
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Button in processing state */
        .processing {
            background-color: #6c757d;
            cursor: not-allowed;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <form id="myForm" action="{{ route('submit.form') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="exampleInput">Example Input</label>
                <input type="text" class="form-control" id="exampleInput" name="example" required>
            </div>

            <button type="submit" id="submitButton" class="btn btn-primary mt-3">
                <span id="spinner"></span>
                <span id="submitText">Submit</span>
            </button>
        </form>
    </div>

    <script>
        // Wait until the DOM is ready
        document.addEventListener('DOMContentLoaded', function() {
            // Get the form and the button
            const form = document.getElementById('myForm');
            const submitButton = document.getElementById('submitButton');
            const spinner = document.getElementById('spinner');
            const submitText = document.getElementById('submitText');

            // Add event listener for form submit
            form.addEventListener('submit', function(e) {
                e.preventDefault(); // Prevent normal form submission

                // Change button to "processing" state
                submitButton.classList.add('processing');
                submitText.textContent = 'Processing...'; // Change text
                spinner.style.display = 'inline-block'; // Show the spinner

                // Simulate form submission (Replace with actual form submission)
                setTimeout(function() {
                    // Normally, here the form will be submitted after processing
                    form.submit();
                }, 2000); // Simulated processing time of 2 seconds
            });
        });
    </script>
</body>
</html>
```

### Explanation:

- The form's `action` is set to route to the controller method `submit.form` (replace it with your actual route).
- The spinner appears and the text changes to "Processing..." when the user clicks the submit button.
- After the simulated processing delay, the form is submitted traditionally using `form.submit()`, which will send the request to your controller.

### Option 2: **AJAX Submission (Without Page Reload)**

If you want to submit the form data to the controller **without refreshing the page**, you can submit it using **AJAX**. This is useful if you want a smoother experience where the user sees the spinner but the page doesn't reload.

Here’s how you can submit data via AJAX to a controller:

#### Example of AJAX Form Submission:

1. **Blade View with AJAX Submission**

```blade
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Button with Spinner</title>

    <style>
        /* Style for the spinner */
        #spinner {
            display: none;
            border: 3px solid transparent;
            border-top: 3px solid #ffffff;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            animation: spin 1s linear infinite;
        }

        /* Keyframes for spinner animation */
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Button in processing state */
        .processing {
            background-color: #6c757d;
            cursor: not-allowed;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <form id="myForm" action="{{ route('submit.form') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="exampleInput">Example Input</label>
                <input type="text" class="form-control" id="exampleInput" name="example" required>
            </div>

            <button type="submit" id="submitButton" class="btn btn-primary mt-3">
                <span id="spinner"></span>
                <span id="submitText">Submit</span>
            </button>
        </form>
    </div>

    <script>
        // Wait until the DOM is ready
        document.addEventListener('DOMContentLoaded', function() {
            // Get the form and the button
            const form = document.getElementById('myForm');
            const submitButton = document.getElementById('submitButton');
            const spinner = document.getElementById('spinner');
            const submitText = document.getElementById('submitText');

            // Add event listener for form submit
            form.addEventListener('submit', function(e) {
                e.preventDefault(); // Prevent normal form submission

                // Change button to "processing" state
                submitButton.classList.add('processing');
                submitText.textContent = 'Processing...'; // Change text
                spinner.style.display = 'inline-block'; // Show the spinner

                // Perform AJAX form submission
                const formData = new FormData(form);

                fetch("{{ route('submit.form') }}", {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    // Handle the response here (e.g., success message)
                    alert('Form submitted successfully');
                    // Reset the button state
                    submitButton.classList.remove('processing');
                    submitText.textContent = 'Submit';
                    spinner.style.display = 'none';
                })
                .catch(error => {
                    // Handle any error here
                    alert('There was an error submitting the form');
                    submitButton.classList.remove('processing');
                    submitText.textContent = 'Submit';
                    spinner.style.display = 'none';
                });
            });
        });
    </script>
</body>
</html>
```

### Explanation:

- **AJAX Submission:**
  - The form submission is intercepted by JavaScript (`e.preventDefault()`).
  - The form data is gathered using `FormData(form)`.
  - The `fetch()` API is used to send the form data to the `submit.form` route. This submits the form asynchronously without page reload.
  - The CSRF token is included in the request headers using `document.querySelector('meta[name="csrf-token"]').getAttribute('content')` to ensure the request is secure.
  - If the submission is successful, a success message will be shown, and the spinner will hide.
  - If there’s an error, an error message will appear, and the button will reset.

### Laravel Controller Handling the Request (Example)

Now, let’s look at how your **controller** might handle this request.

```php
use Illuminate\Http\Request;

class MyController extends Controller
{
    public function submitForm(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'example' => 'required|string|max:255',
        ]);

        // Process the data (e.g., save it to the database)
        // MyModel::create($validated);

        // Return a response (either redirect or JSON for AJAX)
        return response()->json(['message' => 'Form submitted successfully!']);
    }
}
```

### Route for Submission

Ensure that your route for the form submission is defined in `web.php`:

```php
Route::post('/submit-form', [MyController::class, 'submitForm'])->name('submit.form');
```

### Conclusion:

- **Standard Form Submission**: After processing, the form is submitted traditionally (page reload).
- **AJAX Submission**: The form is submitted asynchronously, and the page does not reload. The spinner is shown while processing, and the form submission status is handled dynamically.

This setup should allow you to handle form submission from the frontend with a spinner and processing text in Laravel! Let me know if you need further adjustments.