# ChatBox

ChatBox is a web-based chat application that allows users to communicate with each other in real-time. It's built using PHP, HTML, CSS, JavaScript, and Bootstrap.

## Introduction

ChatBox provides a platform for users to join chat rooms and engage in real-time conversations. It offers a user-friendly interface and supports various features to enhance the chatting experience.

## Features

- **Multi-user Chat**: Users can join multiple chat rooms and communicate with other users simultaneously.
- **Real-time Messaging**: Messages are delivered instantly to all users within the chat room.
- **User Authentication**: Secure authentication system to ensure only registered users can access the chat rooms.
- **Message History**: Chat history is preserved, allowing users to view past messages.
- **File Sharing**: Users can share files, images, and documents within the chat rooms.
- **Customization**: Users can customize their profiles and chat settings.

## Demo

Include a link to a live demo or screenshots demonstrating the functionality of the ChatBox application.

## Technologies Used

- **PHP**: Backend scripting language for server-side functionality.
- **HTML**: Markup language for creating the structure of web pages.
- **CSS**: Stylesheet language for styling the appearance of web pages.
- **JavaScript**: Programming language for client-side interactivity.
- **Bootstrap**: Frontend framework for responsive and mobile-first web development.

## Getting Started

Instructions on how to set up the project locally.

### Prerequisites

- Web server (e.g., Apache)
- PHP >= 7.0
- MySQL or MariaDB database
- Web browser

### Installation

1. Clone the repository to your local machine.
2. Set up a web server with PHP support.
3. Create a new MySQL or MariaDB database named `chatbox`.
4. Import the database schema provided in the `database.sql` file into the `chatbox` database.
5. Configure the database connection in the `config.php` file to match your database credentials.
6. Access the ChatBox application through the web browser.

## Database Structure

### Users Table

- **id**: Primary key
- **username**: Unique username
- **name**: User's name
- **password**: User's password
- **image_url**: URL of user's profile image
- **status**: User's online status

### Messages Table

- **id**: Primary key
- **sender**: Username of the message sender
- **message**: Content of the message
- **sent_at**: Timestamp of when the message was sent

## Usage

Instructions on how to use the ChatBox application, including joining chat rooms, sending messages, and managing user settings.
You can try out the live demo [here](https://dealerpro.rf.gd/chatbox/).
use username : shubham , password : shubham1618
use username : ankit , password : shubham1618
these credential is used to see the live demo of this project.

## License

Do not copy this for business purpose without permission.

