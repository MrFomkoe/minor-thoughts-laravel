## Website for music band The Minor Thoughts
The project was created within the course on Laravel 9.  
The idea of the project is a complete website for the music band, which can be managed via CMS.  

### Features
The website contains the following sections:  
1. The main page which, includes all the necessary information on the band with pre-show of separate sections.  
2. Discograpgy section, which allows to check details on songs and albums. All songs and albums have links to music streaming platforms.  
3. Gigs section, where all past and upcoming gigs (venue, city, date) are shown. Past gigs have links to corresponding image galleries while upcoming have links to related social network pages.  
4. Gallery section, which can be filtered by a gig.  

#### Under the hood  
1. All contents of the website can be managed (added and modified) via the admin dashboard, which requires authentication.  
2. All data is stored in the database utilizing the relational models of Laravel.
3. Interactive elements of the webpage (eg. image sliders) are written in JavaScript.  
4. SCSS is used for styling.   
5. Mass upload of photos and new songs are possible (mass updates and deletes will be implemented in the next revision).