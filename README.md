# Task Tracker API service

## Key principles
- MVC+S architecture which can be moved on top of any framework
- 3 layers of components with a strict hieararchy of interaction which distinguish responsibilities and give easier further support:
  - Controller layer: responsible for HTTP request object validation, calling appropriate service and returning HTTP response;
  - Service layer: Contains business logic, coordinates interactions with Repository (infrastructure) components
  - Repository (Infrastructure) layer: Incapsulates data access functionality
- Ports and Adapters - gives flexibility in usage of different storage engines
- Domain Driven Design

## Patterns used:
- Repository (keeps storage separately from business logic)
- DTO (to ensure data consistency)
- Dependency Inversion (classes rely on interfaces instead of realization)

## Scalability & Extensibility Plan
### Adding comments functionality
Comments might be used either within the Task domain only or could be reused with other domains in the future. This must be clarified with business. 
Keeping comments separately gives a better flexibility for later reusage. Moreover, it gives a possibility to extract this part as a separate micro-app.
Comments will probably require a nested-tree structure, so it makes sense to investigate business requirements and prepare a proper data storage considering data amount. 

### Introducing user roles
User roles give a possibility to restrict some particular methods for user groups. This could require a middleware to check user permissions and restrict access before a request goes to a controller layer.

### Database persistence
Current architecture gives a flexibility to introduce database persistence with adding proper drivers which must implement a `StorageDriverInterface`. 
It will require to establish a connection and include a connection class object on app bootstrap, and not to make index file messy - it makes sense to extract parts of it into configuration directory. 

## Running app
- Clone the code and run it locally with PHP built-in server `php -S localhost:8000 -t public`
- Install composer dependencies (`composer install`) 
- Test API endpoints with HTTP calls 
(Use a curl command `curl -X POST http://localhost:8000/tasks -H "Content-Type: application/json" -d '{"title": "Test task #1", "description": "Test task description"}'` or PostMan app)

### REST API Endpoints

#### POST /tasks
Create a new task

#### GET /tasks
Get all tasks (optional query: status=todo&assigneeId=123)

#### PATCH /tasks/{id}/status
Update the status of a task

#### PATCH /tasks/{id}/assign
Assign a task to a user

