# KrsKu apps
KrsKu is an application for college student to manage their courses, tasks, schedules, etc.

## Features
- Management Semesters
- Management Courses
- Management Ipk
- Management Certificates
- Management Study Targets
- Management Schedules
- Management Tasks, School Presences and Course Teams. 

## Running
copy .env.example to .env and setup your server configuration

- Using Docker
  - requirements:
    - [Docker](https://www.docker.com/)
    - [Docker Compose](https://docs.docker.com/compose/)
  - open file .env, change `WEB_SERVER` to `artisan`
  - run using command line
  ```shell
  > docker-compose up -d --build
  > docker-compose start
  ```
- Using Apache
  - copy root project to your web server document root folder
  - open file .env, change `WEB_SERVER` to `apache` or `docker` or `nginx`
  - access the website through a browser with the url http://localhost/{rootProjectName}/
- Using Artisan
  - open file .env, change `WEB_SERVER` to `artisan`
  - run using command line
  ```shell
  > composer start
  ```
  - access the website through a browser with the url http://localhost:3333

Notes: before running web apps, please create database, and run [migration](https://laravel.com/docs/8.x/migrations) first.
see: [Migration Docs](https://laravel.com/docs/8.x/migrations)

## Demonstration videos
[![Demonstration videos](https://img.youtube.com/vi/jXtLBd3y_f8/0.jpg)](https://www.youtube.com/watch?v=jXtLBd3y_f8)


## Warning !!
This application is currently under development which in the future will be able to manage schools, teachers and students so that it can be integrated with the existing system in each school.

## License

This application is open-sourced code licensed under the [MIT license](https://opensource.org/licenses/MIT).
