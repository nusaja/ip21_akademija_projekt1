### Story 1

**As a** pet lover,
**I want** to see all the different dog and cat breeds or search for a specific one, 
**so that** I can learn about them.

### Acceptance Criteria

```gherkin
Scenario: I want to list all dog breeds 
When I type in "list dog" 
Then I get a list of all dog breeds
```
```gherkin
Scenario: I want to list all cat breeds 
When I type in "list cat" 
Then I get a list of all cat breeds
```
```gherkin
Scenario: I want to list all dog breeds and all cat breeds 
When I type in "list both" 
Then I get a list of all dog breeds and all cat breeds combined 
```
```gherkin
Scenario: I want to search for a dog breed 
When I type in "search dog [breed name]" 
Then I get a list of all dog breeds with that name or containing that name
```
```gherkin
Scenario: I want to search for a dog breed 
When I type in "search dog [breed name]" 
Then I get a list of all dog breeds with that name or containing that name
```
```gherkin
Scenario: I want to search for a cat breed 
When I type in "search cat [breed name]" 
Then I get a list of all cat breeds with that name or containing that name
```
```gherkin
Scenario: I want to search for a breed in both dog and cat breeds
When I type in "search both [breed name]" 
Then I get a list of all breeds with that name or containing that name
```

### Incorrect criteria

```gherkin
When I type in only "list" 
Then I get a message "Please type in: php console.php list [dog/cat/both] OR search [dog/cat/both] [breed name].\n"
```
```gherkin
When I type in "list" incorrectly
Then I get a message "Please type in: php console.php list [dog/cat/both] OR search [dog/cat/both] [breed name].\n"
```
```gherkin
When I type in [dog/cat/both] incorrectly 
Then I get a message "Please type in: php console.php list [dog/cat/both] OR search [dog/cat/both] [breed name].\n"
```
```gherkin
When I type in "list" and [dog/cat/both] in the wrong order
Then I get a message "Please type in: php console.php list [dog/cat/both] OR search [dog/cat/both] [breed name].\n"
```
```gherkin
When I type in only "search" 
Then I get a message "Please type in: php console.php list [dog/cat/both] OR search [dog/cat/both] [breed name].\n"
```
```gherkin
When I type in "search" incorrectly
Then I get a message "Please type in: php console.php list [dog/cat/both] OR search [dog/cat/both] [breed name].\n"
```
```gherkin
When I type in "search [breed name]" without [dog/cat/both]
Then I get a message "Please type in: php console.php list [dog/cat/both] OR search [dog/cat/both] [breed name].\n"
```
```gherkin
When I type in "search", [dog/cat/both] and [breed name] in the wrong order
Then I get a message "Please type in: php console.php list [dog/cat/both] OR search [dog/cat/both] [breed name].\n"
```

### Absurd 

```gherkin
When I type in [breed name] that is longer than 100 characters
Then I get a message "Error: breed name must have from 1-100 alphabetical characters."
```
```gherkin
When I type in [breed name] that is contains characters than are not alphabetical
Then I get a message "Error: breed name must have from 1-100 alphabetical characters."
```


### Resources

* 

### Notes

* 
