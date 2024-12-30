# Product Management System

This project is developed as part of the CS644 Web Programming course at the Arab Academy for Science, Technology & Maritime Transport. It is a web-based application that allows administrators to manage products, including adding new products with images, descriptions, and pricing.

## Features

- **Add New Products**: Administrators can add new products with the following details:

  - Title
  - Description
  - Keywords
  - Category
  - Brand
  - Price
  - Images (up to three)

- **Image Upload with Unique Naming**: Uploaded product images are assigned unique names to prevent filename conflicts and ensure proper storage.

- **Form Validation**: Ensures all required fields are filled out before submission.

- **Prevention of Duplicate Submissions**: Implements measures to prevent duplicate entries when the page is refreshed after form submission.

## Technologies Used

- **Frontend**:

  - HTML5
  - CSS3
  - Bootstrap
  - JavaScript

- **Backend**:

  - PHP

- **Database**:
  - MySQL

## Installation and Setup

1. **Clone the Repository**:

   ```bash
   git clone https://github.com/yourusername/product-management-system.git
   ```

2. **Navigate to the Project Directory**:

   ```bash
   cd product-management-system
   ```

3. **Set Up the Database**:

   - Import the provided SQL file (`database.sql`) into your MySQL database to create the necessary tables.

4. **Configure Database Connection**:

   - Update the `connect.php` file with your database credentials:
     ```php
     <?php
     $con = mysqli_connect("localhost", "username", "password", "database_name");
     if (!$con) {
         die("Connection failed: " . mysqli_connect_error());
     }
     ?>
     ```

5. **Set Up File Permissions**:

   - Ensure the `product_images` directory has the appropriate permissions to allow file uploads:
     ```bash
     chmod 755 product_images
     ```

6. **Run the Application**:
   - Place the project directory in your web server's root directory (e.g., `htdocs` for XAMPP).
   - Access the application via `http://localhost/product-management-system`.

## Usage

1. **Access the Product Insertion Page**:

   - Navigate to `http://localhost/product-management-system/insert_product.php`.

2. **Fill Out the Form**:

   - Enter all required product details.
   - Upload up to three product images.

3. **Submit the Form**:

   - Click the "Insert Product" button to add the product to the database.
   - A success message will be displayed upon successful insertion.

4. **Prevent Duplicate Submissions**:
   - After submission, the page redirects to itself with a success flag to prevent duplicate entries if the page is refreshed.

## Code Highlights

- **Unique Image Naming**:

  ```php
  $extension1 = pathinfo($_FILES['product_image1']['name'], PATHINFO_EXTENSION);
  $product_image1 = uniqid() . '.' . $extension1;
  ```

- **Preventing Duplicate Submissions**:

  ```php
  if ($result_query) {
      header("Location: " . $_SERVER['PHP_SELF'] . "?success=1");
      exit();
  }
  ```

- **Displaying Success Message**:
  ```php
  if (isset($_GET['success']) && $_GET['success'] == 1) {
      echo "<script>alert('Product inserted successfully!')</script>";
  }
  ```

## Acknowledgments

This project is submitted as part of the requirements for the CS644 Web Programming course at the Arab Academy for Science, Technology & Maritime Transport. Special thanks to the course instructors and peers for their guidance and support.

For more information about the Arab Academy for Science, Technology & Maritime Transport, visit their official website: .
