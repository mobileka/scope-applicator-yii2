[![Build Status](https://travis-ci.org/mobileka/scope-applicator-yii2.svg)](https://travis-ci.org/mobileka/scope-applicator-yii2)
[![Code Climate](https://codeclimate.com/github/mobileka/scope-applicator-yii2.svg)](https://codeclimate.com/github/mobileka/scope-applicator-yii2)
[![Coverage Status](https://coveralls.io/repos/mobileka/scope-applicator-yii2/badge.svg?branch=master)](https://coveralls.io/r/mobileka/scope-applicator-yii2?branch=master)

[ScopeApplicator](https://github.com/mobileka/scope-applicator) brings an elegant way of sorting and filtering data to your Yii2 projects.

- [Overview](#overview)
- [Requirements](#requirements)
- [Installation](#installation)
- [Usage](#usage)
- [Contributing](#contributing)
- [License](#license)

## Overview

ScopeApplicator is an easy and logical way to achieve something like this:

`/posts` – returns a list of all posts

`/posts?recent` – returns only recent posts

`/posts?author_id=5` – returns posts belonging to an author with an `id=5`

`/posts?author_id=5&order_by_title=desc&status=active` – returns only active posts belonging to an author with an `id=5` and sorts them by a title in a descending order

## Requirements

– PHP 5.4 or newer

– Yii 2.0.x

## Installation

`composer require mobileka/scope-applicator-yii2 1.0.*`

## Usage

Let's learn by example. First of all, we'll implement an `author_id` filter for `post` table.

These are steps required to achieve this:

1. Create a `PostQuery` class which extends `Mobileka\ScopeApplicator\Yii2\ActiveQuery` and define a `userId` method
2. Create a `Post` model which extends `Mobileka\ScopeApplicator\Yii2\Model` and make it use the `PostQuery` instead of a regular `ActiveQuery`
3. Create a basic `PostController` which outputs a list of posts when `/posts` route is hit
4. Tell ScopeApplicator that `userId` scope is available and give it an alias
5. Visit `/posts?author_id=1` and enjoy the result

Ok, let's cover these step by step.

— Create a `PostQuery` class in `app/models/queries` directory with the following content:

```php
<?php

namespace app\models\queries;

use Mobileka\ScopeApplicator\Yii2\ActiveQuery;

class PostQuery extends ActiveQuery
{
    public function userId($id = 0)
    {
        if ($id) {
            return $this->where(['user_id' => $id]);
        }

        return $this;
    }
}

```

I'll refer the `userId()` method as a `userId` *scope* in the future.

Make sure that this class extends `Mobileka\ScopeApplicator\Yii2\ActiveQuery`.

– Create a `Post` model and override the `find` method like follows:

```php
<?php

namespace app\models;

use app\models\queries\PostQuery;
use Mobileka\ScopeApplicator\Yii2\Model;
use Yii;

class Post extends Model
{
    public static function find()
    {
        return Yii::createObject(PostQuery::className(), [get_called_class()]);
    }
}

```

This makes sure that our `userId` scope will be available to the `Post` model.

– Next, create a `PostController`:

```php
<?php

namespace app\controllers;

use Yii;
use yii\web\Response;
use yii\rest\Controller;
use app\models\Apartment;

class PostController extends Controller
{
    public function actionIndex()
    {
        return Apartment::find()->all();
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator']['formats'] = [
            'application/json' => Response::FORMAT_JSON
        ];

        return $behaviors;
    }
}
```

In this case I extend the `yii\rest\Controller` and make sure that its output format is set to JSON.

– Now let's modify this controller to make it use ScopeApplicator:

```php
<?php

namespace app\controllers;

use Yii;
use yii\web\Response;
use yii\rest\Controller;
use app\models\Apartment;

class PostController extends Controller
{
    /**
     * Scope configuration array
     */
    protected $scopes = ['userId'];

    public function actionIndex()
    {
        return Apartment::applyScopes($this->scopes)->all();
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator']['formats'] = [
            'application/json' => Response::FORMAT_JSON
        ];

        return $behaviors;
    }
}

```

Note that I added a new protected property which describes available scopes. Right now we have only `userId`.

Also note that I have replaced `Apartment::find()` with `Apartment::applyScopes($this->scopes)`.

If you have done all the above steps, you should be able to populate your `post` table and try to filter data like follows:
`/posts?userId=x`.

But we wanted it to be `author_id` instead of `userId`, so we have to configure our scope and add an alias:

```php
<?php

namespace app\controllers;

use Yii;
use yii\web\Response;
use yii\rest\Controller;
use app\models\Apartment;

class PostController extends Controller
{
    /**
     * Scope configuration array
     */
    protected $scopes = [
        'userId' => [
            // here it is!
            'alias' => 'author_id'
        ]
    ];

    public function actionIndex()
    {
        return Apartment::applyScopes($this->scopes)->all();
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator']['formats'] = [
            'application/json' => Response::FORMAT_JSON
        ];

        return $behaviors;
    }
}
```

— That's it! Now you can visit `/posts?author_id=x` and check the result.

`alias` is only one of the many available scope configuration options. These are described in ScopeApplicator's [documentation](https://github.com/mobileka/scope-applicator#configuration-options).

## Contributing

If you have noticed a bug or have suggestions, you can always create an issue or a pull request (use PSR-2). We will discuss the problem or a suggestion and plan the implementation together.

## License

ScopeApplicator is an open-source software and licensed under the [MIT License](https://github.com/mobileka/scope-applicator-yii2/blob/master/license).
