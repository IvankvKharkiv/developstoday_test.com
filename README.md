1. CRUD API test task made for develops.today. Qouted discription of the task will be provided in the very end of readme file.
2. PostMan API collection is in the root of this project. File name: test_task_developstoday.postman_collection.json
3. To run project.
   1. Clone repo.
   2. Run terminal. $ cd repo_folder
   3. docker-compose up -d --build --remove-orphans
   4. If project is up for the second time there is a folder with DB data. It may cause the problem during build. If problems, run: sudo chmod 777 -R docker/sqldatadir/
   5. In terminal: $ sudo nano /etc/hosts
   6. Add line to the hosts: <br> 
   127.0.0.1       developstoday_test.com
   7. Now you can run your project at http://developstoday_test.com:8082.
   8. To see the api platform page run next commands in terminal in project folder: <br>
      $ docker run --rm -it -v $PWD/app:/usr/src/app node bash <br>
      $ cd usr/src/app/ <br>
      $ yarn build <br>
   After that go to http://developstoday_test.com:8082/api
4. Import PostMan API collection from test_task_developstoday.postman_collection.json and test it.

<br>
<br>
<br>

Initial task start:
## **Functional Requirements**

- Create CRUD API to manage news posts. The post will have the next fields: title, link, creation date, amount of upvotes, author-name
- Posts should have CRUD API to manage comments on them. The comment will have the next fields: author-name, content, creation date
- There should be an endpoint to upvote the post
- We should have a recurring job running once a day to reset post upvotes count

## **Technical Requirements**

- Code should be written with PHP 8
- REST API should be Laravel or Symfony based
- API should be well documented with Postman collection. Make sure to use [Postman environments and variables](https://learning.postman.com/docs/postman/variables-and-environments/variables/#understanding-variables-and-environments), so you can switch between local API and deployed version. Add Postman collection link to the README
- API has to run as a Docker container. API + Postgres / MySQL should be launched with docker-compose
- Necessary to make sure that code passes [PSR-12](https://www.php-fig.org/psr/psr-12/) checks using [CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer)
- The project should have clear README with steps to run it
- The code should be clean, passing linter checks and simple to understand. Code quality matters a lot
- Deploy API for testing to [Heroku](https://www.heroku.com/) or similar service. Add deployment link to the README

## **Conditions**

- Task usually takes **from 4 to 6 hours**. If you need more time, you're good to take it and it's appreciated, but results should be sent **no later than 48 hours after the start**
- Skills to write clean business logic and apply best practices are important
- The challenge code should be pushed to the **GitHub** repository.

## Follow Up

Initial task end.