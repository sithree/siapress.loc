<?php

return array(
    'guest' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Guest',
        'bizRule' => null,
        'data' => null
    ),
    'user' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'User',
        'children' => array(
            'guest', // унаследуемся от гостя
        ),
        'bizRule' => null,
        'data' => null
    ),
    'registered' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Registered',
        'children' => array(
            'guest', // унаследуемся от гостя
        ),
        'bizRule' => null,
        'data' => null
    ),
    'official' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Official',
        'children' => array(
            'user', // позволим модератору всё, что позволено пользователю
        ),
        'bizRule' => null,
        'data' => null
    ),
    'author' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Official',
        'children' => array(
            'user', // позволим модератору всё, что позволено пользователю
        ),
        'bizRule' => null,
        'data' => null
    ),
    'author_sia' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Official',
        'children' => array(
            'user', // позволим модератору всё, что позволено пользователю
        ),
        'bizRule' => null,
        'data' => null
    ),
    'moderator' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Moderator',
        'children' => array(
            'user', // позволим модератору всё, что позволено пользователю
        ),
        'bizRule' => null,
        'data' => null
    ),
    'administrator' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Administrator',
        'children' => array(
            'moderator', // позволим админу всё, что позволено модератору
        ),
        'bizRule' => null,
        'data' => null
    ),
);