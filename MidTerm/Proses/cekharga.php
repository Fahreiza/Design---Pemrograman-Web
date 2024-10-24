<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-..." crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <title>Price Check</title>
</head>
<body>
<div class="container-lg mt-2">
    <div class="row">
        <!-- Sidebar -->
        <?php 
        include 'Header.php';
        include 'Sidebar.php';
        ?>

        <!-- End Sidebar -->

        <!-- Main Content for Price Check -->
        <div class="col-lg-9 mt-2">
            <div class="card">
                <div class="card-header">
                    Price Check
                </div>
                <div class="card-body">
                    <h5 class="card-title">Check Prices of Your Laundry</h5>
                    <form id="priceCheckForm">
                        <div class="mb-3">
                            <label for="weight" class="form-label">Weight (in kg)</label>
                            <input type="number" class="form-control" id="weight" placeholder="Enter weight" required min="1">
                        </div>
                        <div class="mb-3">
                            <label for="serviceType" class="form-label">Service Type</label>
                            <select class="form-select" id="serviceType" required>
                                <option value="">Select service</option>
                                <option value="washDry">Wash Dry (1000/kg)</option>
                                <option value="washAndIron">Wash and Ironing (1200/kg)</option>
                                <option value="ironingOnly">Ironing Only (900/kg)</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="transactionType" class="form-label">Transaction Type</label>
                            <select class="form-select" id="transactionType" required>
                                <option value="">Select transaction type</option>
                                <option value="regular">Regular</option>
                                <option value="express">Express (+200/kg)</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="membership" class="form-label">Membership</label>
                            <select class="form-select" id="membership" required>
                                <option value="">Select membership</option>
                                <option value="nonMember">Non Member</option>
                                <option value="member">Member (10% discount)</option>
                            </select>
                        </div>
                        <button type="button" class="btn btn-primary" id="checkPriceBtn">Check Price</button>
                    </form>

                    <hr>
                    <div id="result" class="mt-4">
                        <!-- Price result will be displayed here -->
                    </div>
                </div>
            </div>
        </div>
        <!-- End Main Content -->
    </div>
</div>

<div class="fixed-bottom text-center mb-2">
    &copy; Copyright Rey 2024
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script>
    document.getElementById("checkPriceBtn").addEventListener("click", function() {
        // Get input values
        const weight = Math.ceil(parseInt(document.getElementById("weight").value)); // Round up the weight
        const serviceType = document.getElementById("serviceType").value;
        const transactionType = document.getElementById("transactionType").value;
        const membership = document.getElementById("membership").value;

        // Prices per kilo
        let pricePerKilo;
        if (serviceType === "washDry") {
            pricePerKilo = 1000;
        } else if (serviceType === "washAndIron") {
            pricePerKilo = 1200;
        } else if (serviceType === "ironingOnly") {
            pricePerKilo = 900;
        } else {
            document.getElementById("result").innerHTML = "Please select a valid service type.";
            return;
        }

        // Additional fees
        let additionalFee = 0;
        if (transactionType === "express") {
            additionalFee = 200 * weight; // 200 per kg for express service
        }

        // Calculate subtotal
        let subtotal = (pricePerKilo * weight) + additionalFee;

        // Apply membership discount
        if (membership === "member") {
            subtotal *= 0.9; // 10% discount
        }

        // Display result
        document.getElementById("result").innerHTML = `
            <h6>Total Price:</h6>
            <p>Weight: ${weight} kg</p>
            <p>Service Type: ${serviceType.replace(/([A-Z])/g, ' $1').trim()}</p>
            <p>Transaction Type: ${transactionType}</p>
            <p>Membership: ${membership}</p>
            <p><strong>Total: IDR ${subtotal.toFixed(2)}</strong></p>
        `;
    });
</script>
</body>
</html>
