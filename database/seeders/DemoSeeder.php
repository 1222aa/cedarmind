<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Contact;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\LessonContent;
use App\Models\QuizQuestion;
use Illuminate\Database\Seeder;

class DemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create test users
        $user1 = User::create([
            'name' => 'Test User 1',
            'email' => 'test1@example.com',
            'password' => bcrypt('secret123'),
        ]);

        $user2 = User::create([
            'name' => 'Test User 2',
            'email' => 'test2@example.com',
            'password' => bcrypt('secret123'),
        ]);

        // Create test contacts
        Contact::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'subject' => 'Inquiry about courses',
            'message' => 'Hi, I would like to know more about your web development course.',
            'user_id' => null,
        ]);

        Contact::create([
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'subject' => 'Bug report',
            'message' => 'I found a bug on the login page. The form does not validate properly.',
            'user_id' => $user1->id,
        ]);

        Contact::create([
            'name' => 'Bob Wilson',
            'email' => 'bob@example.com',
            'subject' => 'Feature request',
            'message' => 'Could you add a discussion forum feature?',
            'user_id' => $user2->id,
        ]);

        // Create courses with lessons and content
        $this->createWebDevCourse();
        $this->createDataScienceCourse();
        $this->createDesignCourse();
    }

    private function createWebDevCourse()
    {
        $course = Course::create([
            'title' => 'Intro to Web Development',
            'description' => 'Learn HTML, CSS, and JavaScript from scratch.',
            'long_description' => 'A comprehensive introduction to web development fundamentals. This course covers the essentials of building modern websites, starting with HTML structure, CSS styling, and JavaScript interactivity. Perfect for beginners looking to start their web development journey.',
            'instructor' => 'Sarah Chen',
            'level' => 'Beginner',
            'duration_hours' => 20,
            'learning_outcomes' => [
                'Understand HTML structure and semantic tags',
                'Create responsive layouts with CSS and Flexbox',
                'Write JavaScript functions and handle events',
                'Build interactive web pages',
            ],
        ]);

        // Lesson 1
        $lesson1 = Lesson::create([
            'course_id' => $course->id,
            'title' => 'HTML Fundamentals',
            'description' => 'Introduction to HTML and document structure',
            'order' => 1,
        ]);

        LessonContent::create([
            'lesson_id' => $lesson1->id,
            'type' => 'video',
            'title' => 'Introduction to HTML',
            'content' => 'Learn the basics of HTML and how to structure a webpage.',
            'url' => 'https://www.youtube.com/embed/UB1O30fR-EE',
            'order' => 1,
        ]);

        LessonContent::create([
            'lesson_id' => $lesson1->id,
            'type' => 'written',
            'title' => 'HTML Tags Reference',
            'content' => '<h2>Common HTML Tags</h2><ul><li>&lt;div&gt; - Container for grouping content</li><li>&lt;p&gt; - Paragraph</li><li>&lt;h1-h6&gt; - Headings</li><li>&lt;a&gt; - Links</li><li>&lt;img&gt; - Images</li><li>&lt;form&gt; - Forms</li></ul>',
            'order' => 2,
        ]);

        $quizContent1 = LessonContent::create([
            'lesson_id' => $lesson1->id,
            'type' => 'quiz',
            'title' => 'HTML Fundamentals Quiz',
            'order' => 3,
        ]);

        QuizQuestion::create([
            'lesson_content_id' => $quizContent1->id,
            'question' => 'What does HTML stand for?',
            'options' => ['Hyper Text Markup Language', 'High Tech Modern Language', 'Home Tool Markup Language', 'Hyperlinks and Text Markup Language'],
            'correct_answer' => 'Hyper Text Markup Language',
            'explanation' => 'HTML stands for Hyper Text Markup Language, the standard markup language for creating web pages.',
            'order' => 1,
        ]);

        QuizQuestion::create([
            'lesson_content_id' => $quizContent1->id,
            'question' => 'Which tag is used to define a paragraph in HTML?',
            'options' => ['<para>', '<p>', '<paragraph>', '<p-tag>'],
            'correct_answer' => '<p>',
            'explanation' => 'The <p> tag is used to define a paragraph in HTML.',
            'order' => 2,
        ]);

        // Lesson 2
        $lesson2 = Lesson::create([
            'course_id' => $course->id,
            'title' => 'CSS Styling Basics',
            'description' => 'Learn CSS for styling and layout',
            'order' => 2,
        ]);

        LessonContent::create([
            'lesson_id' => $lesson2->id,
            'type' => 'video',
            'title' => 'CSS Selectors and Properties',
            'content' => 'Master CSS selectors and learn how to style elements.',
            'url' => 'https://www.youtube.com/embed/n4R2Nua40ps',
            'order' => 1,
        ]);

        $quizContent2 = LessonContent::create([
            'lesson_id' => $lesson2->id,
            'type' => 'quiz',
            'title' => 'CSS Basics Quiz',
            'order' => 2,
        ]);

        QuizQuestion::create([
            'lesson_content_id' => $quizContent2->id,
            'question' => 'What is the correct syntax for an external CSS file link?',
            'options' => ['<link href="style.css">', '<link rel="stylesheet" href="style.css">', '<stylesheet src="style.css">', '<css href="style.css">'],
            'correct_answer' => '<link rel="stylesheet" href="style.css">',
            'explanation' => 'The correct syntax is <link rel="stylesheet" href="style.css"> placed in the <head> section.',
            'order' => 1,
        ]);

        // Lesson 3
        $lesson3 = Lesson::create([
            'course_id' => $course->id,
            'title' => 'JavaScript Essentials',
            'description' => 'Introduction to JavaScript programming',
            'order' => 3,
        ]);

        LessonContent::create([
            'lesson_id' => $lesson3->id,
            'type' => 'video',
            'title' => 'JavaScript Basics',
            'url' => 'https://www.youtube.com/embed/W6NZfCO5tTE',
            'content' => 'Learn JavaScript fundamentals and how to interact with the DOM.',
            'order' => 1,
        ]);

        $quizContent3 = LessonContent::create([
            'lesson_id' => $lesson3->id,
            'type' => 'quiz',
            'title' => 'JavaScript Quiz',
            'order' => 2,
        ]);

        QuizQuestion::create([
            'lesson_content_id' => $quizContent3->id,
            'question' => 'Which method is used to select an element by ID in JavaScript?',
            'options' => ['getElementById()', 'getElementByClass()', 'querySelector()', 'selectElement()'],
            'correct_answer' => 'getElementById()',
            'explanation' => 'The getElementById() method is used to select an element by its ID attribute.',
            'order' => 1,
        ]);

        QuizQuestion::create([
            'lesson_content_id' => $quizContent3->id,
            'question' => 'What is the correct way to declare a variable in JavaScript?',
            'options' => ['variable x = 5;', 'var x = 5;', 'v x = 5;', 'declare x = 5;'],
            'correct_answer' => 'var x = 5;',
            'explanation' => 'In JavaScript, variables can be declared using var, let, or const keywords.',
            'order' => 2,
        ]);
    }

    private function createDataScienceCourse()
    {
        $course = Course::create([
            'title' => 'Data Science Basics',
            'description' => 'Master data analysis with Python and practical projects.',
            'long_description' => 'An introductory course to data science using Python. Learn data manipulation, visualization, and basic machine learning concepts through hands-on projects.',
            'instructor' => 'Dr. Michael Zhang',
            'level' => 'Intermediate',
            'duration_hours' => 30,
            'learning_outcomes' => [
                'Load and clean datasets with Pandas',
                'Create visualizations with Matplotlib and Seaborn',
                'Perform exploratory data analysis',
                'Build basic machine learning models',
            ],
        ]);

        // Lesson 1
        $lesson1 = Lesson::create([
            'course_id' => $course->id,
            'title' => 'Python for Data Science',
            'description' => 'Python libraries and tools',
            'order' => 1,
        ]);

        LessonContent::create([
            'lesson_id' => $lesson1->id,
            'type' => 'video',
            'title' => 'Python Libraries Overview',
            'url' => 'https://www.youtube.com/embed/4f0tDEB-nYI',
            'content' => 'Introduction to NumPy, Pandas, and other essential Python libraries.',
            'order' => 1,
        ]);

        $quizContent1 = LessonContent::create([
            'lesson_id' => $lesson1->id,
            'type' => 'quiz',
            'title' => 'Python Libraries Quiz',
            'order' => 2,
        ]);

        QuizQuestion::create([
            'lesson_content_id' => $quizContent1->id,
            'question' => 'Which library is primarily used for numerical computing in Python?',
            'options' => ['Pandas', 'NumPy', 'Matplotlib', 'Seaborn'],
            'correct_answer' => 'NumPy',
            'explanation' => 'NumPy is the fundamental package for numerical computing in Python.',
            'order' => 1,
        ]);

        // Lesson 2
        $lesson2 = Lesson::create([
            'course_id' => $course->id,
            'title' => 'Data Visualization',
            'description' => 'Creating charts and graphs',
            'order' => 2,
        ]);

        LessonContent::create([
            'lesson_id' => $lesson2->id,
            'type' => 'video',
            'title' => 'Matplotlib Fundamentals',
            'url' => 'https://www.youtube.com/embed/qErBw-KJgKw',
            'content' => 'Learn to create beautiful visualizations with Matplotlib.',
            'order' => 1,
        ]);

        $quizContent2 = LessonContent::create([
            'lesson_id' => $lesson2->id,
            'type' => 'quiz',
            'title' => 'Data Visualization Quiz',
            'order' => 2,
        ]);

        QuizQuestion::create([
            'lesson_content_id' => $quizContent2->id,
            'question' => 'What is the purpose of data visualization in data science?',
            'options' => ['To make data look pretty', 'To communicate insights and patterns in data', 'To replace statistical analysis', 'To reduce data size'],
            'correct_answer' => 'To communicate insights and patterns in data',
            'explanation' => 'Data visualization helps communicate complex data insights in an easily understandable format.',
            'order' => 1,
        ]);
    }

    private function createDesignCourse()
    {
        $course = Course::create([
            'title' => 'UX/UI Design Principles',
            'description' => 'Create stunning user experiences with design thinking.',
            'long_description' => 'Learn the principles of user experience and user interface design. This course covers design thinking, wireframing, prototyping, and best practices for creating user-centered digital products.',
            'instructor' => 'Emma Rodriguez',
            'level' => 'Intermediate',
            'duration_hours' => 25,
            'learning_outcomes' => [
                'Understand UX design principles',
                'Create effective wireframes and prototypes',
                'Conduct user research and testing',
                'Design accessible and responsive interfaces',
            ],
        ]);

        // Lesson 1
        $lesson1 = Lesson::create([
            'course_id' => $course->id,
            'title' => 'Design Thinking Fundamentals',
            'description' => 'Introduction to design thinking process',
            'order' => 1,
        ]);

        LessonContent::create([
            'lesson_id' => $lesson1->id,
            'type' => 'video',
            'title' => 'Design Thinking Overview',
            'url' => 'https://www.youtube.com/embed/gHGN3ede2NE',
            'content' => 'Understand the 5 stages of design thinking: Empathize, Define, Ideate, Prototype, Test.',
            'order' => 1,
        ]);

        LessonContent::create([
            'lesson_id' => $lesson1->id,
            'type' => 'presentation',
            'title' => 'Design Thinking Deck',
            'file_path' => '/assets/design-thinking.pdf',
            'order' => 2,
        ]);

        $quizContent1 = LessonContent::create([
            'lesson_id' => $lesson1->id,
            'type' => 'quiz',
            'title' => 'Design Thinking Quiz',
            'order' => 3,
        ]);

        QuizQuestion::create([
            'lesson_content_id' => $quizContent1->id,
            'question' => 'What is the first stage of the design thinking process?',
            'options' => ['Prototype', 'Empathize', 'Ideate', 'Test'],
            'correct_answer' => 'Empathize',
            'explanation' => 'The first stage of design thinking is Empathize, where you seek to understand your users deeply.',
            'order' => 1,
        ]);

        // Lesson 2
        $lesson2 = Lesson::create([
            'course_id' => $course->id,
            'title' => 'Wireframing and Prototyping',
            'description' => 'Creating mockups and prototypes',
            'order' => 2,
        ]);

        LessonContent::create([
            'lesson_id' => $lesson2->id,
            'type' => 'video',
            'title' => 'Wireframing Best Practices',
            'url' => 'https://www.youtube.com/embed/KlR1Dzoy5Vk',
            'content' => 'Learn how to create effective wireframes for your design projects.',
            'order' => 1,
        ]);

        $quizContent2 = LessonContent::create([
            'lesson_id' => $lesson2->id,
            'type' => 'quiz',
            'title' => 'Wireframing Quiz',
            'order' => 2,
        ]);

        QuizQuestion::create([
            'lesson_content_id' => $quizContent2->id,
            'question' => 'What is the primary purpose of a wireframe?',
            'options' => ['To show the final visual design', 'To define the layout and structure of a page', 'To create animations', 'To establish color schemes'],
            'correct_answer' => 'To define the layout and structure of a page',
            'explanation' => 'A wireframe is a low-fidelity representation that focuses on layout and user flow.',
            'order' => 1,
        ]);
    }
}
