<?php

class UserControllerTest extends TestCase
{
    public function testUserProfile()
    {
        $this->get('/v4/users/nekomata1037')
            ->seeStatusCode(200)
            ->seeJsonStructure(['data'=>[
                'mal_id',
                'username',
                'url',
                'images' => [
                    'jpg' => [
                        'image_url'
                    ],
                    'webp' => [
                        'image_url'
                    ]
                ],
                'last_online',
                'gender',
                'birthday',
                'location',
                'joined',
                /* 'anime_stats' => [
                     'days_watched',
                     'mean_score',
                     'watching',
                     'completed',
                     'on_hold',
                     'dropped',
                     'plan_to_watch',
                     'total_entries',
                     'rewatched',
                     'episodes_watched'
                 ],
                 'manga_stats' => [
                     'days_read',
                     'mean_score',
                     'reading',
                     'completed',
                     'on_hold',
                     'dropped',
                     'plan_to_read',
                     'total_entries',
                     'reread',
                     'chapters_read',
                     'volumes_read'
                 ],
                 'favorites' => [
                     'anime' => [
                         [
                             'mal_id',
                             'url',
                             'image_url',
                             'name' // todo should be `title`
                         ]
                     ],
                     'manga' => [],
                     'characters' => [
                         [
                             'mal_id',
                             'url',
                             'image_url',
                             'name'
                         ]
                     ],
                     'people' => [
                         [
                             'mal_id',
                             'url',
                             'image_url',
                             'name'
                         ]
                     ],
                 ],
                 'about'*/
            ]]);
    }

    public function testUserStatistics()
    {
        $this->get('/v4/users/nekomata1037/statistics')
            ->seeStatusCode(200)
            ->seeJsonStructure(['data'=>[

                'anime' => [
                     'days_watched',
                     'mean_score',
                     'watching',
                     'completed',
                     'on_hold',
                     'dropped',
                     'plan_to_watch',
                     'total_entries',
                     'rewatched',
                     'episodes_watched'
                 ],
                 'manga' => [
                     'days_read',
                     'mean_score',
                     'reading',
                     'completed',
                     'on_hold',
                     'dropped',
                     'plan_to_read',
                     'total_entries',
                     'reread',
                     'chapters_read',
                     'volumes_read'
                 ],
            ]]);
    }

    public function testUserAbout()
    {
        $this->get('/v4/users/nekomata1037/about')
            ->seeStatusCode(200)
            ->seeJsonStructure(['data'=>[
                'about',
            ]]);
    }

    public function testUserFavorites()
    {
        $this->get('/v4/users/nekomata1037/favorites')
            ->seeStatusCode(200)
            ->seeJsonStructure(['data'=>[
                'anime' => [
                    [
                        'mal_id',
                        'url',
                        'images' => [
                            'jpg' => [
                                'image_url',
                                'small_image_url',
                                'large_image_url'
                            ],
                            'webp' => [
                                'image_url',
                                'small_image_url',
                                'large_image_url'
                            ],
                        ],
                        'title',
                        'type',
                        'start_year'
                    ]
                ],
                'manga' => [
                    [
                        'mal_id',
                        'url',
                        'images' => [
                            'jpg' => [
                                'image_url',
                                'small_image_url',
                                'large_image_url'
                            ],
                            'webp' => [
                                'image_url',
                                'small_image_url',
                                'large_image_url'
                            ],
                        ],
                        'title',
                        'type',
                        'start_year'
                    ]
                ],
                'characters' => [
                    [
                        'mal_id',
                        'url',
                        'images' => [
                            'jpg' => [
                                'image_url',
                            ],
                            'webp' => [
                                'image_url',
                            ],
                        ],
                        'name',
                        'entry' => [
                            'mal_id',
                            'title',
                            'type',
                            'url'
                        ]
                    ]
                ],
                'people' => [
                    [
                        'mal_id',
                        'url',
                        'images' => [
                            'jpg' => [
                                'image_url',
                            ],
                        ],
                        'name',
                    ]
                ]

            ]]);
    }



    public function testUserHistory()
    {
        $this->get('/v4/users/purplepinapples/history/anime')
            ->seeStatusCode(200)
            ->seeJsonStructure([
                'data' => [
                    [
                        'entry' => [
                            'mal_id',
                            'type',
                            'name',
                            'url'
                        ],
                        'increment',
                        'date'
                    ]
                ]
            ]);

        $this->get('/v4/users/nekomata1037/history/manga')
            ->seeStatusCode(200)
            ->seeJsonStructure([
                'data' => [

                ]
            ]);
    }

    public function testUserFriends()
    {
        $this->get('/v4/users/nekomata1037/friends')
            ->seeStatusCode(200)
            ->seeJsonStructure([
                'meta' => [
                    'last_visible_page',
                    'hast_next_page',
                ],
                'data' => [
                    [
                        'user' => [
                            'username',
                            'url',
                            'images'
                        ],
                        'last_online',
                        'friends_since'
                    ]
                ]
            ]);

        $this->get('/v4/users/nekomata1037/friends?page=200')
            ->seeStatusCode(404);
    }

    public function testUserAnimeList()
    {
        $this->get('/v4/users/nekomata1037/animelist?order_by=last_updated&sort=descending')
            ->seeStatusCode(200)
            ->seeJsonStructure([
                'data' => [
                    [
                        'watching_status',
                        'score',
                        'episodes_watched',
                        'tags',
                        'is_rewatching',
                        'watch_start_date',
                        'watch_end_date',
                        'days',
                        'storage',
                        'priority',
                        'anime' => [
                            'mal_id',
                            'title',
                            'url',
                            'images' => [
                                'jpg' => [
                                    'image_url',
                                    'small_image_url',
                                    'large_image_url'
                                ],
                                'webp' => [
                                    'image_url',
                                    'small_image_url',
                                    'large_image_url'
                                ],
                            ],
                        ],
                        'type',
                        'season',
                        'year',
                        'episodes',
                        'rating',
                        'airing',
                        'aired' => [
                            'from',
                            'to',
                            'prop' => [
                                'from' => [
                                    'day',
                                    'month',
                                    'year'
                                ],
                                'to' => [
                                    'day',
                                    'month',
                                    'year'
                                ]
                            ],
                            'string'
                        ],
                        'studios',
                        'licensors'
                    ]
                ]
            ]);
    }

    public function testUserMangaList()
    {
        $this->get('/v4/users/purplepinapples/mangalist?order_by=last_updated&sort=descending')
            ->seeStatusCode(200)
            ->seeJsonStructure([
                'data' => [
                    [
                        'reading_status',
                        'score',
                        'chapters_read',
                        'tags',
                        'is_rereading',
                        'read_start_date',
                        'read_end_date',
                        'days',
                        'retail',
                        'priority',
                        'manga' => [
                            'mal_id',
                            'title',
                            'url',
                            'images' => [
                                'jpg' => [
                                    'image_url',
                                    'small_image_url',
                                    'large_image_url'
                                ],
                                'webp' => [
                                    'image_url',
                                    'small_image_url',
                                    'large_image_url'
                                ],
                            ],
                        ],
                        'type',
                        'chapters',
                        'volumes',
                        'publishing',
                        'published' => [
                            'from',
                            'to',
                            'prop' => [
                                'from' => [
                                    'day',
                                    'month',
                                    'year'
                                ],
                                'to' => [
                                    'day',
                                    'month',
                                    'year'
                                ]
                            ],
                            'string'
                        ],
                        'magazines'
                    ]
                ]
            ]);
    }

    public function testUserPrivateList()
    {
        $this->get('/v4/user/nekomata1037/mangalist?order_by=last_updated&sort=descending')
            ->seeStatusCode(400);
    }
}
