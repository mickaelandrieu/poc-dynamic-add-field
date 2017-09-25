POC: dynamically load any form field from external services
-----------------------------------------------------------

This application demonstrates how you can alter a simple TodoType form to add new fields without alter directly the related form.



## Install

``composer install && php app/console server:start``

Then you should see a form display with 4 fields:

* Todo
* Due Date
* Description
* Date

If you take a look at the related `TodoType` class, you should see only 2 registered fields.

## Where's the magic?

It's not magic. If you declare new services which implement `FormFieldProviderInterface` and tagged
with the name `form.field_provider`. The declared fields are automatically appended to the selected form.

See for instance what is done to append a "description" field to the `Todo` form type:

```php
<?php
namespace AppBundle\Services;

use AppBundle\Services\FormFieldProviderInterface;

class DescriptionFieldProvider implements FormFieldProviderInterface
{
    public function getFormFields()
    {
        return [
            'todo' => [
                [
                    'name' => 'description',
                    'type' => 'text',
                    'data' => 'A description',
                    'options' => [],
                ],
            ],
        ];
    }
}
```


### Todo

- register a new form type extension, to globally add the `addFieldSubscriber` to all forms.