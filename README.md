blur: Project Overview
===

blur: is an Laravel application that dynamically aggregates information about art exhibitions across Europe. Utilizing Python for efficient web scraping, the project focuses on collecting comprehensive data from web.

**Tech Stack**: Laravel(php), Livewire, AlpineJs, Mysql, Python, ChatGPT Intergration

**The goal of the blur**: project is to create a central hub for art enthusiasts and professionals, providing them with up-to-date, enriched information about the vibrant European art scene.

Data Features
==
**Data Collection**: The application employs web scraping techniques to extract detailed information about ongoing and upcoming art exhibitions throughout Europe.

**Integration with ChatGPT**: A unique aspect of the project is the use of ChatGPT, which helps in generating three relevant keywords for each exhibition. These keywords are chosen to encapsulate the essence of each event.

Homepage Features
==
**Dynamic Loading**: Exhibitions are loaded in increments of 12 as the user scrolls, using Livewire for a smooth, uninterrupted browsing experience.

**Real-Time Search**: Instantly displays search results as users type, offering a fast and responsive way to find specific exhibitions.

**Interactive Tags**: Each exhibition card includes ChatGPT-generated tags. Clicking on a tag filters the exhibitions, allowing for easy exploration based on themes or keywords.

Create Exhibition Page Features
==
**Dual Registration Modes**: This application allows for both automated (by python) and manual entry of exhibition data, offering flexibility in how exhibitions are registered.

**Form Validation with Custom Error Messages**: Utilizing FormRequest, the page implements rules for data validation and displays custom error messages. In case of errors, previously entered values are retained using the "old()" function, enhancing user experience.

**Image Upload Capability**: Users can upload thumbnail images for exhibitions. The code handles potential errors during file storage and updates the database with the image path.

Show a single Exhibition Page Features
==
**Detailed Exhibition Information**: This page provides in-depth details about the exhibition, including descriptions, dates, and location, offering visitors a thorough understanding of the event.

**Comment Section for Members (Livewire)**: Only registered and logged-in members can access the comment feature. It's powered by Livewire, allowing for real-time interaction. Users can post, edit, and delete their comment
