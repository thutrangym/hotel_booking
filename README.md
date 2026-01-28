# 🌅 Sunset Oasis – Hotel Booking Website

Sunset Oasis is an online hotel booking website that allows users to search, book, and manage hotel room reservations with online payment support. The system also provides a powerful admin panel for managing rooms, users, bookings, services, and reviews.

---

## 📌 System Features

### 👤 Guest / User
- Check room availability
- Book hotel rooms
- Manage bookings  
  - Modify booking  
  - Cancel booking  
- Online payment
- Give reviews & ratings for booked rooms and services
- User authentication  
  - Registration  
  - Login / Logout
- Profile management

---

### 🛠️ Admin
- Room management (Add / Edit / Delete rooms)
- User management
- Booking management  
  - Arrival status tracking  
  - Change check-out date  
  - Refund on cancellation & early check-out  
  - Finalize booking  
  - Generate invoice
- Room features & services management  
  - Add / Modify / Delete features & services
- Review & rating management

---

## 🧰 Technologies Used

### Frontend
- HTML5  
- CSS3  
- JavaScript (Vanilla JS)

### Backend
- PHP  
- MySQL

---

## 🧱 System Architecture
```bash
Sunset Oasis

```
---

## 🗄️ Database
The system uses MySQL to store:
- User accounts
- Room and service information
- Booking details
- Reviews and ratings
- Payment and invoice data

---
## ⚙️ Installation & Setup

1. Clone the repository
```bash
git clone https://github.com/your-username/sunset-oasis-hotel-booking.git
```
2. Move the project to your local server directory
(e.g. htdocs for XAMPP)
3. Create a database in MySQL
4. Import the database file
(e.g. sunset_oasis.sql)
5.Configure database connection
Edit config.php:
```bash
$conn = mysqli_connect("localhost", "root", "", "sunset_oasis");
```

6. Start Apache & MySQL
 
7. Open your browser and access:
```bash
   http://localhost/hotel_booking
```
---
##  🔐 User Roles
| Role  | Permissions               |
| ----- | ------------------------- |
| Guest | Booking, payment, reviews |
| Admin | Full system management    |
---
## 🚀 Future Improvements

- Email notifications for booking and cancellation
- Advanced room search and filtering
- Payment gateway integration (VNPay / PayPal)
- Responsive & mobile-friendly UI
- Recommendation system

---
## 📷 Screenshots
