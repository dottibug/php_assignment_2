SportsPro Technical Support App

A web app that tracks incidents, customers, products, and technicians for SportsPro
software.

Database Setup

1. Start MySQL or MariaDB server.
2. Use a database management system to run tech_support.sql as the root user
3. After creating the database and its tables, log in as ts_user@localhost with password
   'pa55word' to begin using the database

Instructions and Manual Testing
NOTE: Relevant error messages should be displayed for all form fields if there is any
incorrectly formatted data. Test each form by purposely entering invalid formats.

Open index.php in a browser.

-- Administrators

1. Select 'Administrators' on the Home page to log in as admin.

-- Manage Products

1. Navigate to 'Manage Products'.
2. Test adding a new product and submitting the form. The new product should appear in the product list after submission.
3. Test deleting a product. The product list should be updated after the product is deleted.

-- Manage Technicians

1. Still logged in as admin, navigate to 'Manage Technicians'.
2. Test adding a new technician and submitting the form. Check that the technician was added to the list.
3. Test deleting a technician from the list. Check that the list was updated after deletion.

-- Manage Customers

1. Logged in as admin, navigate to 'Manage Customers'.
2. Test searching for a customer (relevant error messages should show if the customer was not found).
3. Test adding a new customer. The country dropdown should default to 'Canada'. After submission, search for the customer to make sure the customer was added.
4. Test updating a customer. The country dropdown should default to the customer's country from the database. Make some changes (try invalid data, as well, to check error messages), and submit the form. Search for the customer again to verify that your changes were made.

-- Create Incident

1. Logged in as admin, navigate to 'Create Incident'.
2. Search for a customer and test adding an incident.

-- Display Incident

1. Logged in as admin, navigate to 'Display Incident'.
2. Check out the 'Unassigned' and 'Assigned' incident lists.
3. In the 'Unassigned" list, find the incident you created in the last step to ensure it was added correctly.

-- Assign Incident

1. Logged in as admin, navigate to 'Assign Incident'.
2. Find the incident you previously created and test assigning it to a technician.
3. After assigning the incident, you can return to 'Display Incident' and select the 'Assigned' list to ensure it was assigned correctly.
4. Log out of the admin account.

-- Technicians

1. Select 'Technicians' on the home page and log in as the technician you assigned the incident to.
2. Select the incident from the list and test updating the incident.
3. After updating the incident, it will be considered "closed" and should not show up in the technician's incident list afterwards.
4. Log out of the tech account.

-- Customers

1. Select 'Customers' from the home page and log in as a customer.
2. Test registering a product.
