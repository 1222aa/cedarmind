<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\LessonContent;
use App\Models\QuizQuestion;
use Illuminate\Database\Seeder;

class CustomCoursesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create OOP Course
        $this->createOOPCourse();

        // Create Network Course
        $this->createNetworkCourse();

        // Create Database SQL Course
        $this->createDatabaseSQLCourse();
    }

    private function createOOPCourse()
    {
        $course = Course::create([
            'title' => 'Object-Oriented Programming (OOP)',
            'description' => 'Master the fundamentals of object-oriented programming.',
            'long_description' => 'A comprehensive course on Object-Oriented Programming covering classes, objects, inheritance, polymorphism, encapsulation, and abstraction. Learn how to design and implement robust software systems using OOP principles.',
            'instructor' => 'Software Engineering Expert',
            'level' => 'Intermediate',
            'duration_hours' => 25,
            'learning_outcomes' => [
                'Understand classes and objects',
                'Master inheritance and polymorphism',
                'Learn encapsulation and abstraction',
                'Design scalable software architectures',
                'Implement design patterns',
            ],
        ]);

        // Lesson 1: Introduction to OOP
        $lesson1 = Lesson::create([
            'course_id' => $course->id,
            'title' => 'Introduction to OOP',
            'description' => 'Fundamentals of object-oriented programming',
            'order' => 1,
        ]);

        LessonContent::create([
            'lesson_id' => $lesson1->id,
            'type' => 'video',
            'title' => 'OOP Concepts Overview',
            'content' => 'Learn the core concepts of OOP and why it matters.',
            'url' => 'https://www.youtube.com/embed/pTB0EiLXUC8',
            'order' => 1,
        ]);

        $quiz1 = LessonContent::create([
            'lesson_id' => $lesson1->id,
            'type' => 'quiz',
            'title' => 'Python OOP Basics Quiz',
            'order' => 2,
        ]);

        QuizQuestion::create([
            'lesson_content_id' => $quiz1->id,
            'question' => 'In Python, how do you create a class?',
            'options' => ['class MyClass:', 'define MyClass:', 'object MyClass:', 'type MyClass:'],
            'correct_answer' => 'class MyClass:',
            'explanation' => 'In Python, you use the "class" keyword followed by the class name and a colon to define a class.',
            'order' => 1,
        ]);

        QuizQuestion::create([
            'lesson_content_id' => $quiz1->id,
            'question' => 'What is the special method used to initialize objects in Python?',
            'options' => ['__init__()', '__constructor__()', '__create__()', '__setup__()'],
            'correct_answer' => '__init__()',
            'explanation' => 'The __init__() method is the constructor in Python that initializes new objects of a class.',
            'order' => 2,
        ]);

        QuizQuestion::create([
            'lesson_content_id' => $quiz1->id,
            'question' => 'What does "self" refer to in Python class methods?',
            'options' => ['The current instance of the class', 'The class itself', 'The parent class', 'A static variable'],
            'correct_answer' => 'The current instance of the class',
            'explanation' => '"self" is a reference to the current instance of the class, similar to "this" in other languages.',
            'order' => 3,
        ]);

        QuizQuestion::create([
            'lesson_content_id' => $quiz1->id,
            'question' => 'How do you create inheritance in Python?',
            'options' => ['class Child(Parent):', 'class Child extends Parent:', 'class Child inherits Parent:', 'class Child : Parent:'],
            'correct_answer' => 'class Child(Parent):',
            'explanation' => 'In Python, you create inheritance by passing the parent class in parentheses after the child class name.',
            'order' => 4,
        ]);

        QuizQuestion::create([
            'lesson_content_id' => $quiz1->id,
            'question' => 'What is method overriding in Python OOP?',
            'options' => ['Redefining a parent class method in a child class', 'Using the same method name twice', 'Calling a method multiple times', 'Deleting a method'],
            'correct_answer' => 'Redefining a parent class method in a child class',
            'explanation' => 'Method overriding allows a child class to provide a specific implementation of a method that is already defined in the parent class.',
            'order' => 5,
        ]);

        // Lesson 2: Classes and Objects
        $lesson2 = Lesson::create([
            'course_id' => $course->id,
            'title' => 'Classes and Objects',
            'description' => 'Understanding classes and objects in OOP',
            'order' => 2,
        ]);

        LessonContent::create([
            'lesson_id' => $lesson2->id,
            'type' => 'written',
            'title' => 'Class Definition',
            'content' => '<h2>What is a Class?</h2><p>A class is a blueprint for creating objects. It defines the attributes and methods that objects of that class will have.</p>',
            'order' => 1,
        ]);

        // Lesson 3: Inheritance and Polymorphism
        $lesson3 = Lesson::create([
            'course_id' => $course->id,
            'title' => 'Inheritance and Polymorphism',
            'description' => 'Advanced OOP concepts',
            'order' => 3,
        ]);

        LessonContent::create([
            'lesson_id' => $lesson3->id,
            'type' => 'video',
            'title' => 'Inheritance Explained',
            'content' => 'Learn how to create hierarchies of classes through inheritance.',
            'url' => 'https://www.youtube.com/embed/1SNZvUaparc',
            'order' => 1,
        ]);
    }

    private function createNetworkCourse()
    {
        $course = Course::create([
            'title' => 'Computer Networks',
            'description' => 'Learn the fundamentals of computer networking.',
            'long_description' => 'An in-depth course covering computer networks, TCP/IP protocols, network architecture, and communication systems. Master networking concepts essential for any IT professional.',
            'instructor' => 'Network Security Expert',
            'level' => 'Intermediate',
            'duration_hours' => 30,
            'learning_outcomes' => [
                'Understand OSI and TCP/IP models',
                'Master IP addressing and subnetting',
                'Learn routing and switching concepts',
                'Understand network security basics',
                'Configure and troubleshoot networks',
            ],
        ]);

        // Lesson 1: Network Fundamentals
        $lesson1 = Lesson::create([
            'course_id' => $course->id,
            'title' => 'Network Fundamentals',
            'description' => 'Introduction to computer networks',
            'order' => 1,
        ]);

        LessonContent::create([
            'lesson_id' => $lesson1->id,
            'type' => 'video',
            'title' => 'What are Networks?',
            'content' => 'Introduction to computer networks and their importance.',
            'url' => 'https://www.youtube.com/embed/3QhU9jd6a-o',
            'order' => 1,
        ]);

        $quiz1 = LessonContent::create([
            'lesson_id' => $lesson1->id,
            'type' => 'quiz',
            'title' => 'Network Basics Quiz',
            'order' => 2,
        ]);

        QuizQuestion::create([
            'lesson_content_id' => $quiz1->id,
            'question' => 'What does TCP/IP stand for?',
            'options' => ['Transmission Control Protocol / Internet Protocol', 'Transfer Control Program / Internal Protocol', 'Technical Communication Protocol / IP', 'Transmission Communication / Internet Process'],
            'correct_answer' => 'Transmission Control Protocol / Internet Protocol',
            'explanation' => 'TCP/IP is the fundamental protocol suite for internet communication.',
            'order' => 1,
        ]);

        // Lesson 2: OSI Model
        $lesson2 = Lesson::create([
            'course_id' => $course->id,
            'title' => 'OSI Model',
            'description' => 'Understanding the OSI reference model',
            'order' => 2,
        ]);

        LessonContent::create([
            'lesson_id' => $lesson2->id,
            'type' => 'written',
            'title' => 'OSI Layers',
            'content' => '<h2>The 7 OSI Layers</h2><ol><li>Physical</li><li>Data Link</li><li>Network</li><li>Transport</li><li>Session</li><li>Presentation</li><li>Application</li></ol>',
            'order' => 1,
        ]);

        // Lesson 3: IP Addressing
        $lesson3 = Lesson::create([
            'course_id' => $course->id,
            'title' => 'IP Addressing and Subnetting',
            'description' => 'Mastering IP addresses and subnet masks',
            'order' => 3,
        ]);

        LessonContent::create([
            'lesson_id' => $lesson3->id,
            'type' => 'video',
            'title' => 'IPv4 and IPv6 Addressing',
            'content' => 'Learn about IP address classes and subnetting.',
            'url' => 'https://www.youtube.com/embed/XQ3T14SIlJM',
            'order' => 1,
        ]);
    }

    private function createDatabaseSQLCourse()
    {
        $course = Course::create([
            'title' => 'Database Design and SQL',
            'description' => 'Master database design and SQL programming.',
            'long_description' => 'A comprehensive course on relational database design, normalization, and SQL programming. Learn to design efficient databases and write powerful SQL queries.',
            'instructor' => 'Database Administrator',
            'level' => 'Beginner to Intermediate',
            'duration_hours' => 28,
            'learning_outcomes' => [
                'Understand relational database concepts',
                'Master database normalization',
                'Write complex SQL queries',
                'Design efficient schemas',
                'Optimize database performance',
            ],
        ]);

        // Lesson 1: Database Fundamentals
        $lesson1 = Lesson::create([
            'course_id' => $course->id,
            'title' => 'Database Fundamentals',
            'description' => 'Introduction to databases and SQL',
            'order' => 1,
        ]);

        LessonContent::create([
            'lesson_id' => $lesson1->id,
            'type' => 'video',
            'title' => 'Introduction to Databases',
            'content' => 'Learn what databases are and why they are essential.',
            'url' => 'https://www.youtube.com/embed/ufVN2l1EXqE',
            'order' => 1,
        ]);

        $quiz1 = LessonContent::create([
            'lesson_id' => $lesson1->id,
            'type' => 'quiz',
            'title' => 'Database Basics Quiz',
            'order' => 2,
        ]);

        QuizQuestion::create([
            'lesson_content_id' => $quiz1->id,
            'question' => 'What does SQL stand for?',
            'options' => ['Structured Query Language', 'Standard Question Language', 'System Query Logic', 'Structured Quick Language'],
            'correct_answer' => 'Structured Query Language',
            'explanation' => 'SQL stands for Structured Query Language, used to manage relational databases.',
            'order' => 1,
        ]);

        // Lesson 2: SQL Queries
        $lesson2 = Lesson::create([
            'course_id' => $course->id,
            'title' => 'SQL Queries',
            'description' => 'Writing basic and advanced SQL queries',
            'order' => 2,
        ]);

        LessonContent::create([
            'lesson_id' => $lesson2->id,
            'type' => 'written',
            'title' => 'SELECT, INSERT, UPDATE, DELETE',
            'content' => '<h2>CRUD Operations in SQL</h2><p>SELECT - Retrieve data</p><p>INSERT - Add new records</p><p>UPDATE - Modify existing records</p><p>DELETE - Remove records</p>',
            'order' => 1,
        ]);

        // Lesson 3: Database Design
        $lesson3 = Lesson::create([
            'course_id' => $course->id,
            'title' => 'Database Design and Normalization',
            'description' => 'Designing efficient database schemas',
            'order' => 3,
        ]);

        LessonContent::create([
            'lesson_id' => $lesson3->id,
            'type' => 'video',
            'title' => 'Database Normalization',
            'content' => 'Learn about normal forms and database optimization.',
            'url' => 'https://www.youtube.com/embed/aNicMcSb9ek',
            'order' => 1,
        ]);

        $quiz3 = LessonContent::create([
            'lesson_id' => $lesson3->id,
            'type' => 'quiz',
            'title' => 'Normalization Quiz',
            'order' => 2,
        ]);

        QuizQuestion::create([
            'lesson_content_id' => $quiz3->id,
            'question' => 'What is the primary purpose of database normalization?',
            'options' => ['To reduce data redundancy', 'To increase storage space', 'To slow down queries', 'To complicate schema design'],
            'correct_answer' => 'To reduce data redundancy',
            'explanation' => 'Database normalization reduces data redundancy and improves data integrity.',
            'order' => 1,
        ]);
    }
}
