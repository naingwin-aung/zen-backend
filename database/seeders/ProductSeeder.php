<?php

namespace Database\Seeders;

use App\Enums\ClosingTypeEnum;
use App\Enums\ServiceEnum;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * Country IDs:  Singapore=152, Thailand=165, Japan=83, Indonesia=78, UAE=200, Malaysia=101
     * City IDs:     Tokyo=1, Bangkok=17, Singapore=87, Phuket=7024, Dubai=221, Kuala Lumpur=48
     * Category IDs: Activities=1
     * Age group IDs: Adult=1, Child=2
     */
    public function run(): void
    {
        /** @var array<int, array<string, mixed>> $products */
        $products = [
            [
                'name' => 'Universal Studios Singapore',
                'star_rating' => 4.8,
                'search_keywords' => 'theme park, rides, singapore, uss, movie, entertainment',
                'what_to_expect' => 'Experience world-class rides and attractions based on your favourite blockbuster films at Universal Studios Singapore.',
                'good_to_know' => 'Arrive early to beat the queues. Height restrictions apply to some rides.',
                'highlights' => 'Transformers The Ride, Battlestar Galactica, Sesame Street, Madagascar',
                'start_date' => '2026-01-01',
                'end_date' => '2026-12-31',
                'closing_type' => ClosingTypeEnum::CLOSING_DAYS->value,
                'closing_days' => ['Wednesday'],
                'countries' => [152],
                'cities' => [87],
                'categories' => [1],
                'images' => [
                    'https://i.pinimg.com/736x/0d/54/96/0d5496fc4f97559742811ef84f9e3791.jpg',
                    'https://i.pinimg.com/736x/f3/5f/ca/f35fca60a7b28dbd5def45fc2e778db7.jpg',
                ],
                'packages' => [
                    [
                        'name' => 'Standard Day Pass',
                        'description' => 'Full day access to all Universal Studios Singapore zones.',
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 83.00],
                            ['age_group_id' => 2, 'price' => 61.00],
                        ],
                    ],
                    [
                        'name' => 'Express Pass',
                        'description' => 'Skip the queues with the Universal Express Pass.',
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 150.00],
                            ['age_group_id' => 2, 'price' => 120.00],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Marina Bay Sands SkyPark Observation Deck',
                'star_rating' => 4.7,
                'search_keywords' => 'marina bay sands, skypark, observation, singapore, rooftop, view',
                'what_to_expect' => 'Enjoy breathtaking 360-degree panoramic views of the Singapore skyline from the iconic SkyPark atop Marina Bay Sands.',
                'good_to_know' => 'Non-hotel guests can visit the observation deck. Sunset views are spectacular.',
                'highlights' => 'Infinity pool views, city skyline panorama, Gardens by the Bay views',
                'start_date' => '2026-01-01',
                'end_date' => '2026-12-31',
                'closing_type' => null,
                'closing_days' => [],
                'countries' => [152],
                'cities' => [87],
                'categories' => [1],
                'images' => [
                    'https://i.pinimg.com/736x/db/59/b9/db59b95a7a1ecde42917f94654967896.jpg',
                    'https://i.pinimg.com/736x/e5/ad/0f/e5ad0fdf08ed00432d239ca0d5ae9f39.jpg',
                ],
                'packages' => [
                    [
                        'name' => 'Observation Deck Ticket',
                        'description' => 'Access to the SkyPark Observation Deck.',
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 32.00],
                            ['age_group_id' => 2, 'price' => 22.00],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Phi Phi Island Tour by Speedboat',
                'star_rating' => 4.9,
                'search_keywords' => 'phi phi, speedboat, island, phuket, thailand, beach, snorkeling',
                'what_to_expect' => 'Explore the stunning Phi Phi Islands including Maya Bay, Monkey Beach, and crystal-clear lagoons by private speedboat.',
                'good_to_know' => 'Bring sunscreen and a swimsuit. Seasickness bags are available on board.',
                'highlights' => 'Maya Bay, Monkey Beach, snorkelling, Pileh Lagoon',
                'start_date' => '2026-01-01',
                'end_date' => '2026-12-31',
                'closing_type' => ClosingTypeEnum::CLOSING_DAYS->value,
                'closing_days' => ['Sunday'],
                'countries' => [165],
                'cities' => [7024],
                'categories' => [1],
                'images' => [
                    'https://i.pinimg.com/736x/94/89/56/9489563afebd7bf38cb0729002a3b3ce.jpg',
                    'https://i.pinimg.com/736x/7c/60/61/7c606105a2c45ada47bf20e6186cda53.jpg',
                ],
                'packages' => [
                    [
                        'name' => 'Shared Speedboat Tour',
                        'description' => 'Join a small group speedboat tour to Phi Phi Islands.',
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 65.00],
                            ['age_group_id' => 2, 'price' => 45.00],
                        ],
                    ],
                    [
                        'name' => 'Private Speedboat Charter',
                        'description' => 'Exclusive private speedboat for your group.',
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 220.00],
                            ['age_group_id' => 2, 'price' => 220.00],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Elephant Nature Park Chiang Mai',
                'star_rating' => 4.9,
                'search_keywords' => 'elephant, sanctuary, chiang mai, thailand, ethical, wildlife',
                'what_to_expect' => 'Spend a day at an ethical elephant sanctuary where you can feed, bathe, and interact with rescued elephants in their natural habitat.',
                'good_to_know' => 'No riding. Wear clothes you do not mind getting muddy. Vegetarian lunch included.',
                'highlights' => 'Feeding elephants, mud bath, river walk, rescue stories',
                'start_date' => '2026-01-01',
                'end_date' => '2026-12-31',
                'closing_type' => null,
                'closing_days' => [],
                'countries' => [165],
                'cities' => [17],
                'categories' => [1],
                'images' => [
                    'https://i.pinimg.com/736x/05/d9/7e/05d97eae007a5938fa3cb19f77ca0067.jpg',
                    'https://i.pinimg.com/736x/bb/9b/6b/bb9b6b839f1b813c86bd7a1eeae562e0.jpg',
                ],
                'packages' => [
                    [
                        'name' => 'Full Day Experience',
                        'description' => 'A full day at the elephant nature park including meals.',
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 80.00],
                            ['age_group_id' => 2, 'price' => 60.00],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Tokyo DisneySea',
                'star_rating' => 4.9,
                'search_keywords' => 'disney, tokyo, theme park, japan, disneysea, rides, fantasy',
                'what_to_expect' => 'Tokyo DisneySea is a one-of-a-kind Disney theme park featuring seven unique themed ports inspired by world mythology and legend.',
                'good_to_know' => 'Book tickets well in advance. The park can be very busy on weekends and holidays.',
                'highlights' => 'Tower of Terror, Raging Spirits, Fantasmic!, Venetian gondolas',
                'start_date' => '2026-01-01',
                'end_date' => '2026-12-31',
                'closing_type' => null,
                'closing_days' => [],
                'countries' => [83],
                'cities' => [1],
                'categories' => [1],
                'images' => [
                    'https://i.pinimg.com/736x/8a/4c/01/8a4c01d2d03741b0be0d85e830419e0d.jpg',
                    'https://i.pinimg.com/736x/ae/c2/f9/aec2f98a89784796d41fb2146aaadefb.jpg',
                ],
                'packages' => [
                    [
                        'name' => '1-Day Passport',
                        'description' => 'One-day entry to Tokyo DisneySea.',
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 72.00],
                            ['age_group_id' => 2, 'price' => 58.00],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Mount Fuji Day Trip from Tokyo',
                'star_rating' => 4.7,
                'search_keywords' => 'mount fuji, fuji, tokyo, japan, hiking, scenic, lake kawaguchiko',
                'what_to_expect' => 'Take a guided day trip from Tokyo to explore Mount Fuji, Lake Kawaguchiko, and the Fuji Five Lakes region.',
                'good_to_know' => 'Climbing season is July–September. Views depend on weather conditions.',
                'highlights' => 'Fifth Station viewpoint, Lake Kawaguchiko, traditional lunch, scenic drives',
                'start_date' => '2026-01-01',
                'end_date' => '2026-12-31',
                'closing_type' => null,
                'closing_days' => [],
                'countries' => [83],
                'cities' => [1],
                'categories' => [1],
                'images' => [
                    'https://i.pinimg.com/736x/da/8f/0f/da8f0ff6c89e329b99c6d6a381443dec.jpg',
                    'https://i.pinimg.com/736x/f8/68/22/f86822db6373419bfef3781f7935d286.jpg',
                ],
                'packages' => [
                    [
                        'name' => 'Guided Day Tour',
                        'description' => 'Full-day guided tour from Tokyo to Mount Fuji and surroundings.',
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 95.00],
                            ['age_group_id' => 2, 'price' => 65.00],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Dubai Desert Safari with BBQ Dinner',
                'star_rating' => 4.8,
                'search_keywords' => 'desert safari, dubai, uae, sand dunes, barbecue, camel, belly dance',
                'what_to_expect' => 'Experience an exhilarating dune bashing adventure in the Dubai desert, followed by a traditional Bedouin camp dinner under the stars.',
                'good_to_know' => 'Not recommended for pregnant women or those with back problems. Dress modestly at the camp.',
                'highlights' => 'Dune bashing, camel riding, BBQ dinner, belly dance, henna painting',
                'start_date' => '2026-01-01',
                'end_date' => '2026-12-31',
                'closing_type' => null,
                'closing_days' => [],
                'countries' => [200],
                'cities' => [221],
                'categories' => [1],
                'images' => [
                    'https://i.pinimg.com/736x/a7/ee/5d/a7ee5db0e807f21edd79056c0da53328.jpg',
                    'https://i.pinimg.com/736x/07/3b/8e/073b8edbd8e9dcee6b1b89462eaa6bfd.jpg',
                ],
                'packages' => [
                    [
                        'name' => 'Evening Desert Safari',
                        'description' => 'Standard evening desert safari with BBQ dinner.',
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 55.00],
                            ['age_group_id' => 2, 'price' => 35.00],
                        ],
                    ],
                    [
                        'name' => 'VIP Desert Safari',
                        'description' => 'Premium experience with private camp and gourmet dinner.',
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 130.00],
                            ['age_group_id' => 2, 'price' => 100.00],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Burj Khalifa At The Top Experience',
                'star_rating' => 4.7,
                'search_keywords' => 'burj khalifa, dubai, observation deck, uae, skyscraper, at the top',
                'what_to_expect' => 'Ascend the world\'s tallest building and admire stunning panoramic views of Dubai from the 124th or 148th floor observation decks.',
                'good_to_know' => 'Book tickets online in advance to avoid queues. Sunset slots sell out fastest.',
                'highlights' => 'Views from 124th floor, outdoor terrace, telescope stations, sunset views',
                'start_date' => '2026-01-01',
                'end_date' => '2026-12-31',
                'closing_type' => null,
                'closing_days' => [],
                'countries' => [200],
                'cities' => [221],
                'categories' => [1],
                'images' => [
                    'https://i.pinimg.com/736x/44/f8/3d/44f83d698b364eaafda3640906d28f4e.jpg',
                    'https://i.pinimg.com/736x/2f/e4/44/2fe4446515632975beab7d321c44fd38.jpg',
                ],
                'packages' => [
                    [
                        'name' => 'At The Top (124th Floor)',
                        'description' => 'Entry to the 124th floor observation deck.',
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 40.00],
                            ['age_group_id' => 2, 'price' => 25.00],
                        ],
                    ],
                    [
                        'name' => 'At The Top Sky (148th Floor)',
                        'description' => 'Premium entry to the 148th floor with lounge access.',
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 120.00],
                            ['age_group_id' => 2, 'price' => 90.00],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Bali Ubud Cultural Tour',
                'star_rating' => 4.6,
                'search_keywords' => 'bali, ubud, culture, indonesia, temple, rice terrace, monkey forest',
                'what_to_expect' => 'Discover the spiritual and cultural heart of Bali with visits to the Sacred Monkey Forest, Tegallalang Rice Terraces, and Pura Tirta Empul temple.',
                'good_to_know' => 'Bring a sarong for temple visits. Some areas can be slippery during rainy season.',
                'highlights' => 'Monkey Forest, Tegallalang Rice Terraces, Tirta Empul Temple, Ubud Market',
                'start_date' => '2026-01-01',
                'end_date' => '2026-12-31',
                'closing_type' => null,
                'closing_days' => [],
                'countries' => [78],
                'cities' => [87],
                'categories' => [1],
                'images' => [
                    'https://i.pinimg.com/736x/86/16/e3/8616e323045160f4c5909babdd20626a.jpg',
                    'https://i.pinimg.com/736x/41/be/99/41be99e050577c28b6d1d8aa623b3fbf.jpg',
                ],
                'packages' => [
                    [
                        'name' => 'Full Day Ubud Tour',
                        'description' => 'All-inclusive full day cultural tour of Ubud.',
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 50.00],
                            ['age_group_id' => 2, 'price' => 30.00],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Kuala Lumpur Twin Towers Sky Bridge',
                'star_rating' => 4.5,
                'search_keywords' => 'petronas, twin towers, kuala lumpur, malaysia, skybridge, observation, klcc',
                'what_to_expect' => 'Visit the iconic Petronas Twin Towers and walk across the Sky Bridge connecting the two towers at Level 41.',
                'good_to_know' => 'Tickets are limited. Book online at least a day in advance. Photography allowed.',
                'highlights' => 'Sky Bridge on Level 41, Observation Deck on Level 86, city views',
                'start_date' => '2026-01-01',
                'end_date' => '2026-12-31',
                'closing_type' => ClosingTypeEnum::CLOSING_DAYS->value,
                'closing_days' => ['Monday'],
                'countries' => [101],
                'cities' => [48],
                'categories' => [1],
                'images' => [
                    'https://i.pinimg.com/736x/e9/0c/62/e90c62679b6fceff1ef1c299895d7588.jpg',
                    'https://i.pinimg.com/736x/87/98/2a/87982a235d529bad2d7adefeac778e2d.jpg',
                ],
                'packages' => [
                    [
                        'name' => 'Sky Bridge + Observation Deck',
                        'description' => 'Combined access to Sky Bridge and Observation Deck.',
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 20.00],
                            ['age_group_id' => 2, 'price' => 10.00],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Bangkok Grand Palace & Wat Pho Tour',
                'star_rating' => 4.6,
                'search_keywords' => 'bangkok, grand palace, wat pho, reclining buddha, thailand, temple, history',
                'what_to_expect' => 'Explore the magnificent Grand Palace complex and the nearby Wat Pho temple home to the famous Reclining Buddha.',
                'good_to_know' => 'Dress code strictly enforced — cover shoulders and knees. Tours usually last 3–4 hours.',
                'highlights' => 'Emerald Buddha Temple, Grand Palace architecture, Reclining Buddha, Wat Pho massage school',
                'start_date' => '2026-01-01',
                'end_date' => '2026-12-31',
                'closing_type' => null,
                'closing_days' => [],
                'countries' => [165],
                'cities' => [17],
                'categories' => [1],
                'images' => [
                    'https://i.pinimg.com/736x/76/7f/ab/767fabe7ec6eb2417b75963d7de17a8c.jpg',
                    'https://i.pinimg.com/736x/2f/3b/9a/2f3b9a41c75d59f8b47edfdbbe653501.jpg',
                ],
                'packages' => [
                    [
                        'name' => 'Guided Walking Tour',
                        'description' => 'Guided walking tour of Grand Palace and Wat Pho with entrance fees.',
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 45.00],
                            ['age_group_id' => 2, 'price' => 25.00],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Chao Phraya River Dinner Cruise',
                'star_rating' => 4.5,
                'search_keywords' => 'bangkok, chao phraya, river cruise, dinner, thailand, night, boat',
                'what_to_expect' => 'Cruise the Chao Phraya River by night aboard a luxury boat and enjoy a sumptuous Thai buffet dinner while passing illuminated temples and city landmarks.',
                'good_to_know' => 'Smart casual dress is recommended. Vegetarian options available on request.',
                'highlights' => 'Candlelit dinner, live Thai music, Wat Arun night views, Rama VIII Bridge',
                'start_date' => '2026-01-01',
                'end_date' => '2026-12-31',
                'closing_type' => null,
                'closing_days' => [],
                'countries' => [165],
                'cities' => [17],
                'categories' => [1],
                'images' => [
                    'https://i.pinimg.com/736x/c4/f3/4e/c4f34e0973c45b4bc4c92a84cde04813.jpg',
                    'https://i.pinimg.com/736x/8d/79/f5/8d79f5bd8799937b1d02af868ac457f9.jpg',
                ],
                'packages' => [
                    [
                        'name' => 'Dinner Cruise Ticket',
                        'description' => 'Two-hour river dinner cruise with unlimited Thai buffet.',
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 60.00],
                            ['age_group_id' => 2, 'price' => 35.00],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Singapore Night Safari',
                'star_rating' => 4.7,
                'search_keywords' => 'singapore, night safari, zoo, animals, wildlife, nocturnal, tram',
                'what_to_expect' => 'Embark on the world\'s first nocturnal zoo experience, spotting over 2,500 nocturnal animals across seven geographic zones.',
                'good_to_know' => 'No flash photography. Tram tours run every 8 minutes. Insect repellent recommended.',
                'highlights' => 'Tram safari, Creatures of the Night show, Fishing Cat Trail, Giant Flying Squirrel',
                'start_date' => '2026-01-01',
                'end_date' => '2026-12-31',
                'closing_type' => null,
                'closing_days' => [],
                'countries' => [152],
                'cities' => [87],
                'categories' => [1],
                'images' => [
                    'https://i.pinimg.com/736x/8e/cd/8b/8ecd8be442c39e65080f90c4db5d3b6c.jpg',
                    'https://i.pinimg.com/736x/7c/a5/b2/7ca5b2e916a61386c4f1e1c4571f812d.jpg',
                ],
                'packages' => [
                    [
                        'name' => 'Night Safari Admission',
                        'description' => 'Full admission to Singapore Night Safari including tram ride.',
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 49.00],
                            ['age_group_id' => 2, 'price' => 34.00],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Gardens by the Bay Supertree Show',
                'star_rating' => 4.6,
                'search_keywords' => 'gardens by the bay, singapore, supertree, flower dome, cloud forest, light show',
                'what_to_expect' => 'Wander through the iconic Supertree Grove and watch the Garden Rhapsody light and sound show, then explore the Flower Dome and Cloud Forest conservatories.',
                'good_to_know' => 'Light shows at 7:45pm and 8:45pm daily. Conservatories are air-conditioned.',
                'highlights' => 'Supertree Grove, Garden Rhapsody show, Flower Dome, Cloud Forest waterfall',
                'start_date' => '2026-01-01',
                'end_date' => '2026-12-31',
                'closing_type' => null,
                'closing_days' => [],
                'countries' => [152],
                'cities' => [87],
                'categories' => [1],
                'images' => [
                    'https://i.pinimg.com/736x/2f/5f/8f/2f5f8f539f73db560dba5540a5a58d97.jpg',
                    'https://i.pinimg.com/736x/a2/fb/a4/a2fba432b601cc7d4da6b3cd54d81d4c.jpg',
                ],
                'packages' => [
                    [
                        'name' => 'Conservatories Combo',
                        'description' => 'Admission to Flower Dome and Cloud Forest.',
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 28.00],
                            ['age_group_id' => 2, 'price' => 15.00],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Kyoto Geisha District Walking Tour',
                'star_rating' => 4.8,
                'search_keywords' => 'kyoto, geisha, gion, japan, historic, walking tour, maiko, temple',
                'what_to_expect' => 'Walk through the atmospheric lanes of Gion — Kyoto\'s famous geisha district — with a knowledgeable guide sharing the history and traditions of the geisha culture.',
                'good_to_know' => 'Evening tours offer the best chance of spotting geisha. Respectful behaviour in the district is essential.',
                'highlights' => 'Gion district, Hanamikoji Street, Yasaka Shrine, local tea house visit',
                'start_date' => '2026-04-01',
                'end_date' => '2026-11-30',
                'closing_type' => null,
                'closing_days' => [],
                'countries' => [83],
                'cities' => [1],
                'categories' => [1],
                'images' => [
                    'https://i.pinimg.com/736x/64/36/a0/6436a09491e330c7e9f0a536d67a1962.jpg',
                    'https://i.pinimg.com/736x/a1/59/a7/a159a7250d758f343dba84e72c129da9.jpg',
                ],
                'packages' => [
                    [
                        'name' => 'Evening Walking Tour',
                        'description' => 'Two-hour evening guided walk through Gion district.',
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 55.00],
                            ['age_group_id' => 2, 'price' => 35.00],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Dubai Frame Entrance Ticket',
                'star_rating' => 4.4,
                'search_keywords' => 'dubai frame, uae, landmark, old dubai, new dubai, bridge, observation',
                'what_to_expect' => 'Walk through the Dubai Frame — the world\'s largest picture frame — with stunning views of old and new Dubai from the glass-floored sky bridge.',
                'good_to_know' => 'Moderately priced attraction. Great for families. Allow 1–2 hours.',
                'highlights' => 'Glass-floored sky bridge, panoramic views, diorama experiences, history of Dubai',
                'start_date' => '2026-01-01',
                'end_date' => '2026-12-31',
                'closing_type' => null,
                'closing_days' => [],
                'countries' => [200],
                'cities' => [221],
                'categories' => [1],
                'images' => [
                    'https://i.pinimg.com/736x/14/73/8f/14738f55c98f795234fdb8f518c6ea8d.jpg',
                    'https://i.pinimg.com/736x/a8/cd/a3/a8cda353c0a4f8520abcc307c7f46b30.jpg',
                ],
                'packages' => [
                    [
                        'name' => 'General Admission',
                        'description' => 'Standard entry to the Dubai Frame.',
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 16.00],
                            ['age_group_id' => 2, 'price' => 8.00],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Langkawi Cable Car & Sky Bridge',
                'star_rating' => 4.5,
                'search_keywords' => 'langkawi, cable car, sky bridge, malaysia, gondola, mountain, rainforest',
                'what_to_expect' => 'Ride the Langkawi Cable Car to the peak of Mount Mat Cincang and walk across the breathtaking curved Sky Bridge suspended over the rainforest canopy.',
                'good_to_know' => 'Sky Bridge may be closed during thunderstorms. Wear comfortable footwear.',
                'highlights' => 'Gondola ride, Sky Bridge walkway, panoramic Andaman Sea views, rainforest scenery',
                'start_date' => '2026-01-01',
                'end_date' => '2026-12-31',
                'closing_type' => ClosingTypeEnum::CLOSING_DAYS->value,
                'closing_days' => ['Tuesday'],
                'countries' => [101],
                'cities' => [48],
                'categories' => [1],
                'images' => [
                    'https://i.pinimg.com/736x/2e/64/43/2e6443e148865ba957f247fb769a7ac2.jpg',
                    'https://i.pinimg.com/736x/a4/14/95/a41495c6df655176952904fa65c53422.jpg',
                ],
                'packages' => [
                    [
                        'name' => 'Cable Car + Sky Bridge',
                        'description' => 'Return cable car ride and Sky Bridge access.',
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 25.00],
                            ['age_group_id' => 2, 'price' => 18.00],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Bali Tanah Lot Sunset Tour',
                'star_rating' => 4.7,
                'search_keywords' => 'bali, tanah lot, sunset, temple, indonesia, ocean, culture, photography',
                'what_to_expect' => 'Watch one of Bali\'s most magical sunsets at the legendary Tanah Lot sea temple perched on a rocky outcrop surrounded by ocean waves.',
                'good_to_know' => 'Visit during low tide for best temple access. Arrive 1 hour before sunset for good spots.',
                'highlights' => 'Tanah Lot temple, ocean sunset, holy snake shrine, local crafts market',
                'start_date' => '2026-01-01',
                'end_date' => '2026-12-31',
                'closing_type' => null,
                'closing_days' => [],
                'countries' => [78],
                'cities' => [87],
                'categories' => [1],
                'images' => [
                    'https://i.pinimg.com/736x/63/ad/8b/63ad8bc82c2afd963220e907c761dc55.jpg',
                    'https://i.pinimg.com/736x/db/bc/38/dbbc381db6096f30aade6b8540b54668.jpg',
                ],
                'packages' => [
                    [
                        'name' => 'Sunset Tour with Transfer',
                        'description' => 'Guided Tanah Lot sunset tour with hotel pickup and drop-off.',
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 35.00],
                            ['age_group_id' => 2, 'price' => 20.00],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Bangkok Floating Market Experience',
                'star_rating' => 4.5,
                'search_keywords' => 'bangkok, floating market, damnoen saduak, boat, food, thailand, canal',
                'what_to_expect' => 'Glide through the canals of Damnoen Saduak floating market on a traditional longtail boat and sample local Thai food directly from the vendors\' boats.',
                'good_to_know' => 'Mornings are the best time to visit. Bargaining is expected and part of the fun.',
                'highlights' => 'Longtail boat ride, fresh tropical fruits, Thai snacks, canal life, photo opportunities',
                'start_date' => '2026-01-01',
                'end_date' => '2026-12-31',
                'closing_type' => null,
                'closing_days' => [],
                'countries' => [165],
                'cities' => [17],
                'categories' => [1],
                'images' => [
                    'https://i.pinimg.com/736x/eb/8c/b0/eb8cb0953d43d666ec5058df7a3dd90c.jpg',
                    'https://i.pinimg.com/736x/2d/90/64/2d9064237c1e2fa01b1017a25737ae77.jpg',
                ],
                'packages' => [
                    [
                        'name' => 'Floating Market Half Day Tour',
                        'description' => 'Half-day guided tour to Damnoen Saduak including boat ride.',
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 40.00],
                            ['age_group_id' => 2, 'price' => 25.00],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Sentosa Island Hop-On Hop-Off',
                'star_rating' => 4.3,
                'search_keywords' => 'sentosa, singapore, beach, cable car, adventure, resort, island',
                'what_to_expect' => 'Discover all of Sentosa Island\'s highlights at your own pace with an all-day hop-on hop-off bus and beach tram pass.',
                'good_to_know' => 'Bring swimwear for the beaches. Most beaches are free to access with the pass.',
                'highlights' => 'Palawan Beach, Siloso Beach, Fort Siloso, Adventure Cove, cable car views',
                'start_date' => '2026-01-01',
                'end_date' => '2026-12-31',
                'closing_type' => null,
                'closing_days' => [],
                'countries' => [152],
                'cities' => [87],
                'categories' => [1],
                'images' => [
                    'https://i.pinimg.com/736x/7a/78/6a/7a786ad288f66402916fe131095c2ba3.jpg',
                    'https://i.pinimg.com/736x/84/e5/77/84e577082cfdac25c314a81101bc34ce.jpg',
                ],
                'packages' => [
                    [
                        'name' => 'All-Day Island Pass',
                        'description' => 'Unlimited hop-on hop-off access across Sentosa for a full day.',
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 22.00],
                            ['age_group_id' => 2, 'price' => 14.00],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Phuket Snorkelling Day Trip to Coral Island',
                'star_rating' => 4.6,
                'search_keywords' => 'phuket, coral island, snorkelling, koh hae, beach, thailand, speedboat',
                'what_to_expect' => 'Take a speedboat to Coral Island (Koh Hae) and enjoy snorkelling in clear turquoise waters teeming with tropical fish and vibrant coral reefs.',
                'good_to_know' => 'Snorkelling equipment provided. Non-swimmers can use life jackets. Lunch included.',
                'highlights' => 'Coral reef snorkelling, white sand beach, tropical fish, longtail boat rides',
                'start_date' => '2026-01-01',
                'end_date' => '2026-04-30',
                'closing_type' => null,
                'closing_days' => [],
                'countries' => [165],
                'cities' => [7024],
                'categories' => [1],
                'images' => [
                    'https://i.pinimg.com/736x/41/2c/58/412c58f0856db45352bcc1ca5e4700a8.jpg',
                    'https://i.pinimg.com/736x/8f/f2/a3/8ff2a346beae39584dc974bdc1ae056f.jpg',
                ],
                'packages' => [
                    [
                        'name' => 'Full Day Snorkelling Trip',
                        'description' => 'Full-day snorkelling excursion to Coral Island with lunch.',
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 55.00],
                            ['age_group_id' => 2, 'price' => 35.00],
                        ],
                    ],
                ],
            ],

            // ── 20 Thailand-Only Products ──────────────────────────────────────
            // Country ID: Thailand=165
            // City IDs: Bangkok=17, Phuket=7024, Chiang Mai=601, Pattaya=1962,
            //           Ko Samui=7880, Hua Hin=8320, Ayutthaya=10484,
            //           Krabi=15486, Kanchanaburi=19074
            [
                'name' => 'Ayutthaya Historical Park Day Tour',
                'star_rating' => 4.7,
                'search_keywords' => 'ayutthaya, historical park, ruins, thailand, ancient, unesco, temple',
                'what_to_expect' => 'Journey back in time exploring the ancient capital of Ayutthaya, a UNESCO World Heritage Site with stunning temple ruins and enormous Buddha statues.',
                'good_to_know' => 'Best visited by bicycle or tuk-tuk. Dress modestly for temple sites. Avoid midday heat.',
                'highlights' => 'Wat Mahathat, Wat Phra Si Sanphet, Buddha head in tree roots, Wat Chai Watthanaram',
                'start_date' => '2026-01-01',
                'end_date' => '2026-12-31',
                'closing_type' => null,
                'closing_days' => [],
                'countries' => [165],
                'cities' => [10484],
                'categories' => [1],
                'images' => [
                    'https://i.pinimg.com/736x/6a/8e/fc/6a8efcacf578a4f42742ae366c9fed88.jpg',
                    'https://i.pinimg.com/736x/bf/8e/79/bf8e795a9dd401b75f76f26565657e51.jpg',
                ],
                'packages' => [
                    [
                        'name' => 'Full Day Ayutthaya Tour',
                        'description' => 'Guided full-day tour to Ayutthaya from Bangkok with lunch and entrance fees.',
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 50.00],
                            ['age_group_id' => 2, 'price' => 30.00],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Khao Sok National Park Floating Raft House',
                'star_rating' => 4.8,
                'search_keywords' => 'khao sok, national park, raft house, lake, jungle, thailand, cheow lan',
                'what_to_expect' => 'Spend the night on a floating raft house in the heart of Cheow Lan Lake, surrounded by towering limestone karsts and pristine jungle.',
                'good_to_know' => 'Bring insect repellent and a torch. No electricity after midnight. Swimming in the lake is permitted.',
                'highlights' => 'Cheow Lan Lake, kayaking, jungle trekking, wildlife spotting, sunrise over karsts',
                'start_date' => '2026-01-01',
                'end_date' => '2026-12-31',
                'closing_type' => null,
                'closing_days' => [],
                'countries' => [165],
                'cities' => [7024],
                'categories' => [1],
                'images' => [
                    'https://i.pinimg.com/736x/12/12/c2/1212c27dbfcfcb6fd976b75728464fb1.jpg',
                    'https://i.pinimg.com/736x/be/3b/1a/be3b1a76fd201bf8a498d9358a6e1d7d.jpg',
                ],
                'packages' => [
                    [
                        'name' => '2-Day 1-Night Raft House Package',
                        'description' => 'Two-day package with overnight raft house stay, meals, and guided activities.',
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 120.00],
                            ['age_group_id' => 2, 'price' => 85.00],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'James Bond Island Phang Nga Bay Tour',
                'star_rating' => 4.7,
                'search_keywords' => 'james bond island, phang nga bay, phuket, thailand, khao phing kan, limestone, sea cave',
                'what_to_expect' => 'Cruise through the dramatic sea caves and limestone pillars of Phang Nga Bay and visit the iconic James Bond Island featured in The Man with the Golden Gun.',
                'good_to_know' => 'Can get crowded midday. Morning departures are recommended. Sea canoe tours available.',
                'highlights' => 'James Bond Island, Phang Nga Bay, sea caves, Koh Panyee floating village, kayaking',
                'start_date' => '2026-01-01',
                'end_date' => '2026-12-31',
                'closing_type' => null,
                'closing_days' => [],
                'countries' => [165],
                'cities' => [7024],
                'categories' => [1],
                'images' => [
                    'https://i.pinimg.com/736x/91/1b/50/911b50893491f3b746e2db43139dd9c9.jpg',
                    'https://i.pinimg.com/736x/99/0b/e6/990be64fa92a5c869871bb9656163c9d.jpg',
                ],
                'packages' => [
                    [
                        'name' => 'Full Day Boat Tour',
                        'description' => 'Full-day longtail boat tour to James Bond Island with lunch at Koh Panyee.',
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 60.00],
                            ['age_group_id' => 2, 'price' => 40.00],
                        ],
                    ],
                    [
                        'name' => 'Sea Canoe + James Bond Island',
                        'description' => 'Premium sea canoe experience through sea caves combined with James Bond Island visit.',
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 100.00],
                            ['age_group_id' => 2, 'price' => 70.00],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Railay Beach Krabi Longtail Boat Day Trip',
                'star_rating' => 4.8,
                'search_keywords' => 'railay beach, krabi, longtail, thailand, rock climbing, lagoon, caves',
                'what_to_expect' => 'Reach the stunning car-free Railay Beach peninsula by traditional longtail boat and spend the day exploring its white sand coves, lagoon, and sea caves.',
                'good_to_know' => 'Accessible only by boat. Water shoes recommended. Best visited outside monsoon season.',
                'highlights' => 'Railay West beach, Phra Nang Cave Beach, hidden lagoon, rock climbing cliffs, snorkelling',
                'start_date' => '2026-11-01',
                'end_date' => '2026-04-30',
                'closing_type' => null,
                'closing_days' => [],
                'countries' => [165],
                'cities' => [15486],
                'categories' => [1],
                'images' => [
                    'https://i.pinimg.com/736x/2e/9a/43/2e9a43b401f394dd7b66a2c32e5d62b4.jpg',
                    'https://i.pinimg.com/736x/2c/df/2f/2cdf2fca82b131edac496dbccba03939.jpg',
                ],
                'packages' => [
                    [
                        'name' => 'Railay Beach Day Trip',
                        'description' => 'Return longtail boat transfer plus full day at Railay Beach.',
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 45.00],
                            ['age_group_id' => 2, 'price' => 28.00],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Chiang Mai Night Bazaar & Walking Street',
                'star_rating' => 4.5,
                'search_keywords' => 'chiang mai, night bazaar, walking street, thailand, shopping, street food, wualai',
                'what_to_expect' => 'Explore the vibrant Chiang Mai Night Bazaar and Saturday/Sunday Walking Streets, browsing handcrafted goods and sampling authentic northern Thai street food.',
                'good_to_know' => 'Saturday Walking Street is on Wualai Road; Sunday Walking Street is on Nimman Road area. Bargaining accepted.',
                'highlights' => 'Handmade crafts, northern Thai street food, live performances, Chang Khlan Road market',
                'start_date' => '2026-01-01',
                'end_date' => '2026-12-31',
                'closing_type' => null,
                'closing_days' => [],
                'countries' => [165],
                'cities' => [601],
                'categories' => [1],
                'images' => [
                    'https://i.pinimg.com/736x/8b/95/b9/8b95b9256672c8de5903f09939588d9a.jpg',
                    'https://i.pinimg.com/736x/0a/34/c0/0a34c0c2d225927230f1cac055b7230f.jpg',
                ],
                'packages' => [
                    [
                        'name' => 'Evening Night Market Tour',
                        'description' => 'Guided 3-hour evening tour of Chiang Mai Night Bazaar and walking street.',
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 25.00],
                            ['age_group_id' => 2, 'price' => 15.00],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Doi Inthanon National Park Trekking Tour',
                'star_rating' => 4.7,
                'search_keywords' => 'doi inthanon, national park, chiang mai, thailand, highest peak, waterfall, bird watching',
                'what_to_expect' => 'Visit Thailand\'s highest peak at Doi Inthanon National Park, trekking through cloud forest, visiting twin royal pagodas, and seeing spectacular waterfalls.',
                'good_to_know' => 'Temperatures can be cool at the summit — bring a jacket. Park entrance fee required.',
                'highlights' => 'Summit at 2,565m, Wachirathan Waterfall, twin royal chedis, hill tribe villages, rare birds',
                'start_date' => '2026-01-01',
                'end_date' => '2026-12-31',
                'closing_type' => null,
                'closing_days' => [],
                'countries' => [165],
                'cities' => [601],
                'categories' => [1],
                'images' => [
                    'https://i.pinimg.com/736x/93/88/36/938836bccef89ceb4890906b29ef7e0c.jpg',
                    'https://i.pinimg.com/736x/5f/4d/46/5f4d46dbdfc67429477e91d6eba4c802.jpg',
                ],
                'packages' => [
                    [
                        'name' => 'Full Day Doi Inthanon Tour',
                        'description' => 'Guided full-day tour from Chiang Mai with lunch and park entrance fees.',
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 65.00],
                            ['age_group_id' => 2, 'price' => 45.00],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Erawan National Park Waterfall Hike',
                'star_rating' => 4.8,
                'search_keywords' => 'erawan, waterfall, national park, kanchanaburi, thailand, emerald, swim, seven tiers',
                'what_to_expect' => 'Hike through the lush jungle of Erawan National Park to the famous seven-tiered emerald-green waterfalls, swimming in natural pools beneath the falls.',
                'good_to_know' => 'Visit early to avoid crowds. Wear sturdy shoes and bring a swimsuit. Fish nibble at your feet in the pools.',
                'highlights' => 'Seven-tier waterfall, emerald pools, swimming, jungle trail, tropical fish',
                'start_date' => '2026-01-01',
                'end_date' => '2026-12-31',
                'closing_type' => null,
                'closing_days' => [],
                'countries' => [165],
                'cities' => [19074],
                'categories' => [1],
                'images' => [
                    'https://i.pinimg.com/736x/b2/cc/60/b2cc60a7231d797677398b5df3621789.jpg',
                    'https://i.pinimg.com/736x/0d/88/26/0d8826e477ac7d55f96a5c1a6165bd1b.jpg',
                ],
                'packages' => [
                    [
                        'name' => 'Erawan Day Trip from Bangkok',
                        'description' => 'Full-day guided trip to Erawan waterfalls from Bangkok with transport.',
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 55.00],
                            ['age_group_id' => 2, 'price' => 35.00],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Koh Samui Full-Island Highlights Tour',
                'star_rating' => 4.6,
                'search_keywords' => 'koh samui, island tour, thailand, big buddha, fisherman village, secret garden',
                'what_to_expect' => 'Discover the best of Koh Samui on a guided island highlights tour visiting Big Buddha, Fisherman\'s Village, the Secret Buddha Garden, and pristine viewpoints.',
                'good_to_know' => 'Comfortable walking shoes recommended. Tour duration approximately 6 hours. Includes lunch.',
                'highlights' => 'Big Buddha Temple, Fisherman\'s Village Walking Street, Secret Buddha Garden, Grandfather Rock',
                'start_date' => '2026-01-01',
                'end_date' => '2026-12-31',
                'closing_type' => null,
                'closing_days' => [],
                'countries' => [165],
                'cities' => [7880],
                'categories' => [1],
                'images' => [
                    'https://i.pinimg.com/736x/be/79/02/be7902e385ac52c755fa7e28c5e61c2a.jpg',
                    'https://i.pinimg.com/736x/86/16/e3/8616e323045160f4c5909babdd20626a.jpg',
                ],
                'packages' => [
                    [
                        'name' => 'Island Highlights Half Day',
                        'description' => 'Half-day guided tour covering the main Koh Samui highlights.',
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 40.00],
                            ['age_group_id' => 2, 'price' => 25.00],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'River Kwai Bridge & JEATH War Museum',
                'star_rating' => 4.5,
                'search_keywords' => 'river kwai, bridge, kanchanaburi, jeath museum, thailand, wwii, history, death railway',
                'what_to_expect' => 'Pay your respects at one of history\'s most poignant WWII sites — the famous Bridge over the River Kwai — and learn about the Death Railway at the JEATH War Museum.',
                'good_to_know' => 'Walk or cycle over the bridge. Visit the Allied War Cemetery. Best combined with Erawan Falls.',
                'highlights' => 'Bridge over River Kwai, JEATH War Museum, Death Railway, Kanchanaburi War Cemetery',
                'start_date' => '2026-01-01',
                'end_date' => '2026-12-31',
                'closing_type' => null,
                'closing_days' => [],
                'countries' => [165],
                'cities' => [19074],
                'categories' => [1],
                'images' => [
                    'https://i.pinimg.com/736x/41/be/99/41be99e050577c28b6d1d8aa623b3fbf.jpg',
                    'https://i.pinimg.com/736x/2e/64/43/2e6443e148865ba957f247fb769a7ac2.jpg',
                ],
                'packages' => [
                    [
                        'name' => 'Kanchanaburi History Day Trip',
                        'description' => 'Full-day tour from Bangkok including River Kwai Bridge and war museum.',
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 48.00],
                            ['age_group_id' => 2, 'price' => 28.00],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Muay Thai Boxing Live Show Bangkok',
                'star_rating' => 4.7,
                'search_keywords' => 'muay thai, boxing, bangkok, lumpinee, rajadamnern, thailand, fight, stadium',
                'what_to_expect' => 'Witness the ancient art of Muay Thai boxing live at one of Bangkok\'s legendary stadiums, with professional bouts, traditional rituals, and electric atmosphere.',
                'good_to_know' => 'Ringside seats sell out fast. Arrive 30 minutes early. Photography permitted. Bouts start 6pm.',
                'highlights' => 'Professional Muay Thai bouts, pre-fight rituals, live musicians, ringside atmosphere',
                'start_date' => '2026-01-01',
                'end_date' => '2026-12-31',
                'closing_type' => ClosingTypeEnum::CLOSING_DAYS->value,
                'closing_days' => ['Sunday'],
                'countries' => [165],
                'cities' => [17],
                'categories' => [1],
                'images' => [
                    'https://i.pinimg.com/736x/a4/14/95/a41495c6df655176952904fa65c53422.jpg',
                    'https://i.pinimg.com/736x/63/ad/8b/63ad8bc82c2afd963220e907c761dc55.jpg',
                ],
                'packages' => [
                    [
                        'name' => 'Ringside Seat Ticket',
                        'description' => 'Premium ringside seat with pre-fight ceremony views.',
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 50.00],
                            ['age_group_id' => 2, 'price' => 35.00],
                        ],
                    ],
                    [
                        'name' => 'Standard Seat Ticket',
                        'description' => 'Standard stadium seat for the Muay Thai fights.',
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 25.00],
                            ['age_group_id' => 2, 'price' => 15.00],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Thai Cooking Class Bangkok',
                'star_rating' => 4.9,
                'search_keywords' => 'thai cooking class, bangkok, thailand, pad thai, green curry, tom yum, street food',
                'what_to_expect' => 'Learn to cook authentic Thai dishes in a hands-on cooking class led by a professional chef, starting with a market visit to choose fresh local ingredients.',
                'good_to_know' => 'Vegetarian options available. All ingredients and equipment provided. Take home a recipe book.',
                'highlights' => 'Market visit, cook 4–5 dishes, Pad Thai, Tom Yum, green curry, mango sticky rice',
                'start_date' => '2026-01-01',
                'end_date' => '2026-12-31',
                'closing_type' => null,
                'closing_days' => [],
                'countries' => [165],
                'cities' => [17],
                'categories' => [1],
                'images' => [
                    'https://i.pinimg.com/736x/db/bc/38/dbbc381db6096f30aade6b8540b54668.jpg',
                    'https://i.pinimg.com/736x/7a/78/6a/7a786ad288f66402916fe131095c2ba3.jpg',
                ],
                'packages' => [
                    [
                        'name' => 'Half Day Cooking Class',
                        'description' => 'Half-day class cooking 4 traditional Thai dishes with market visit.',
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 45.00],
                            ['age_group_id' => 2, 'price' => 30.00],
                        ],
                    ],
                    [
                        'name' => 'Full Day Cooking Class',
                        'description' => 'Full-day class cooking 6 dishes with extended market tour and lunch.',
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 75.00],
                            ['age_group_id' => 2, 'price' => 50.00],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Sukhothai Historical Park Cycling Tour',
                'star_rating' => 4.7,
                'search_keywords' => 'sukhothai, historical park, cycling, thailand, ancient, ruins, lotus, buddha, unesco',
                'what_to_expect' => 'Cycle leisurely through the ancient Sukhothai Historical Park — the birthplace of the Thai nation — exploring majestic ruins, seated Buddha statues, and lotus-filled moats.',
                'good_to_know' => 'Bicycle rental included. Best time to visit is early morning or late afternoon. Entrance fee payable on-site.',
                'highlights' => 'Wat Mahathat, Wat Si Chum giant Buddha, lotus-filled ponds, bike paths through ruins',
                'start_date' => '2026-01-01',
                'end_date' => '2026-12-31',
                'closing_type' => null,
                'closing_days' => [],
                'countries' => [165],
                'cities' => [17],
                'categories' => [1],
                'images' => [
                    'https://i.pinimg.com/736x/84/e5/77/84e577082cfdac25c314a81101bc34ce.jpg',
                    'https://i.pinimg.com/736x/41/2c/58/412c58f0856db45352bcc1ca5e4700a8.jpg',
                ],
                'packages' => [
                    [
                        'name' => 'Self-Guided Cycling Tour',
                        'description' => 'Bicycle rental and park map for a self-guided tour of the Historical Park.',
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 18.00],
                            ['age_group_id' => 2, 'price' => 10.00],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Nong Nooch Tropical Garden Pattaya',
                'star_rating' => 4.5,
                'search_keywords' => 'nong nooch, tropical garden, pattaya, thailand, elephant show, cultural, orchid',
                'what_to_expect' => 'Wander through the award-winning Nong Nooch Tropical Garden in Pattaya, home to sculpted hedges, orchid collections, and traditional Thai cultural shows with elephant performances.',
                'good_to_know' => 'Cultural shows run daily. Tram rides available around the garden. Allow 3–4 hours.',
                'highlights' => 'European topiary garden, orchid nursery, Thai cultural show, elephant show, cycad valley',
                'start_date' => '2026-01-01',
                'end_date' => '2026-12-31',
                'closing_type' => null,
                'closing_days' => [],
                'countries' => [165],
                'cities' => [1962],
                'categories' => [1],
                'images' => [
                    'https://i.pinimg.com/736x/8f/f2/a3/8ff2a346beae39584dc974bdc1ae056f.jpg',
                    'https://i.pinimg.com/736x/94/89/56/9489563afebd7bf38cb0729002a3b3ce.jpg',
                ],
                'packages' => [
                    [
                        'name' => 'Garden Admission + Cultural Show',
                        'description' => 'Entry to Nong Nooch Garden with Thai cultural performance included.',
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 20.00],
                            ['age_group_id' => 2, 'price' => 12.00],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Sanctuary of Truth Pattaya',
                'star_rating' => 4.6,
                'search_keywords' => 'sanctuary of truth, pattaya, thailand, carved wood, temple, sculpture, ocean',
                'what_to_expect' => 'Marvel at the breathtaking all-wood Sanctuary of Truth — a living sculpture built entirely without nails — featuring intricate hand-carved mythological figures inspired by ancient Khmer and Thai art.',
                'good_to_know' => 'Construction is ongoing; some areas may have scaffolding. Cultural show at 11:30am and 3:30pm. No shorts.',
                'highlights' => 'All-wood architecture, mythological carvings, ocean-side location, Thai-Khmer art fusion',
                'start_date' => '2026-01-01',
                'end_date' => '2026-12-31',
                'closing_type' => null,
                'closing_days' => [],
                'countries' => [165],
                'cities' => [1962],
                'categories' => [1],
                'images' => [
                    'https://i.pinimg.com/736x/7c/60/61/7c606105a2c45ada47bf20e6186cda53.jpg',
                    'https://i.pinimg.com/736x/05/d9/7e/05d97eae007a5938fa3cb19f77ca0067.jpg',
                ],
                'packages' => [
                    [
                        'name' => 'Sanctuary Entrance Ticket',
                        'description' => 'Standard entry to the Sanctuary of Truth including cultural show.',
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 22.00],
                            ['age_group_id' => 2, 'price' => 12.00],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Koh Lanta 4-Island Snorkelling Tour',
                'star_rating' => 4.7,
                'search_keywords' => 'koh lanta, island hopping, snorkelling, krabi, thailand, 4 islands, reef, beach',
                'what_to_expect' => 'Hop between four stunning islands around Koh Lanta by speedboat, snorkelling in crystal-clear waters and relaxing on some of Thailand\'s most beautiful and uncrowded beaches.',
                'good_to_know' => 'Snorkelling gear included. Sunscreen and swimwear essential. Lunch served on-board.',
                'highlights' => 'Koh Mook, Koh Kradan, Koh Chuak, Emerald Cave (Tham Morakot), coral reefs',
                'start_date' => '2026-11-01',
                'end_date' => '2026-04-30',
                'closing_type' => null,
                'closing_days' => [],
                'countries' => [165],
                'cities' => [15486],
                'categories' => [1],
                'images' => [
                    'https://i.pinimg.com/736x/bb/9b/6b/bb9b6b839f1b813c86bd7a1eeae562e0.jpg',
                    'https://i.pinimg.com/736x/76/7f/ab/767fabe7ec6eb2417b75963d7de17a8c.jpg',
                ],
                'packages' => [
                    [
                        'name' => '4-Island Full Day Speedboat',
                        'description' => 'Full-day speedboat island hopping tour with snorkelling and lunch.',
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 70.00],
                            ['age_group_id' => 2, 'price' => 50.00],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Similan Islands Liveaboard Snorkelling',
                'star_rating' => 4.9,
                'search_keywords' => 'similan islands, liveaboard, snorkelling, diving, phuket, thailand, national marine park',
                'what_to_expect' => 'Join a 2-day 1-night liveaboard to the legendary Similan Islands National Marine Park, renowned for having some of Southeast Asia\'s clearest waters and best marine life.',
                'good_to_know' => 'Park is open November–May only. Diving certification not required for snorkellers. Seasickness medication available.',
                'highlights' => 'Pristine coral reefs, whale sharks, manta rays, white sand beaches, underwater visibility up to 30m',
                'start_date' => '2026-11-01',
                'end_date' => '2026-04-30',
                'closing_type' => null,
                'closing_days' => [],
                'countries' => [165],
                'cities' => [7024],
                'categories' => [1],
                'images' => [
                    'https://i.pinimg.com/736x/2f/3b/9a/2f3b9a41c75d59f8b47edfdbbe653501.jpg',
                    'https://i.pinimg.com/736x/c4/f3/4e/c4f34e0973c45b4bc4c92a84cde04813.jpg',
                ],
                'packages' => [
                    [
                        'name' => '2D1N Snorkelling Liveaboard',
                        'description' => 'Overnight liveaboard with all meals, snorkelling gear, and 6 snorkelling stops.',
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 180.00],
                            ['age_group_id' => 2, 'price' => 130.00],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Doi Suthep Temple & Hmong Village Tour',
                'star_rating' => 4.6,
                'search_keywords' => 'doi suthep, temple, chiang mai, thailand, wat phra that, hmong, mountain, gold stupa',
                'what_to_expect' => 'Ascend to the sacred Doi Suthep temple high above Chiang Mai, admiring its golden chedi and sweeping city views, then visit a traditional Hmong hill tribe village.',
                'good_to_know' => 'Climb the 309-step Naga staircase or take the tram. Dress code: cover shoulders and knees. No shoes inside temple.',
                'highlights' => 'Golden chedi, panoramic Chiang Mai views, Naga staircase, Hmong village, handicrafts market',
                'start_date' => '2026-01-01',
                'end_date' => '2026-12-31',
                'closing_type' => null,
                'closing_days' => [],
                'countries' => [165],
                'cities' => [601],
                'categories' => [1],
                'images' => [
                    'https://i.pinimg.com/736x/8d/79/f5/8d79f5bd8799937b1d02af868ac457f9.jpg',
                    'https://i.pinimg.com/736x/14/73/8f/14738f55c98f795234fdb8f518c6ea8d.jpg',
                ],
                'packages' => [
                    [
                        'name' => 'Doi Suthep Half Day Tour',
                        'description' => 'Half-day guided tour to Doi Suthep temple and Hmong village from Chiang Mai.',
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 30.00],
                            ['age_group_id' => 2, 'price' => 18.00],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Khao Yai National Park Wildlife Safari',
                'star_rating' => 4.7,
                'search_keywords' => 'khao yai, national park, wildlife, safari, thailand, elephants, hornbill, overnight',
                'what_to_expect' => 'Explore Khao Yai — Thailand\'s oldest national park and UNESCO World Heritage Site — on a guided jeep safari spotting wild elephants, hornbills, monkeys, and diverse bird species.',
                'good_to_know' => 'Guided safaris run morning and evening. Bring binoculars and mosquito repellent. 2-day trips recommended.',
                'highlights' => 'Wild elephant sightings, greater hornbills, gibbon calls, Haew Narok waterfall, night safari',
                'start_date' => '2026-01-01',
                'end_date' => '2026-12-31',
                'closing_type' => null,
                'closing_days' => [],
                'countries' => [165],
                'cities' => [17],
                'categories' => [1],
                'images' => [
                    'https://i.pinimg.com/736x/a8/cd/a3/a8cda353c0a4f8520abcc307c7f46b30.jpg',
                    'https://i.pinimg.com/736x/eb/8c/b0/eb8cb0953d43d666ec5058df7a3dd90c.jpg',
                ],
                'packages' => [
                    [
                        'name' => 'Full Day Khao Yai Safari',
                        'description' => 'Full-day guided wildlife safari from Bangkok including park fees and lunch.',
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 85.00],
                            ['age_group_id' => 2, 'price' => 60.00],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Hua Hin Beach & Cicada Night Market',
                'star_rating' => 4.4,
                'search_keywords' => 'hua hin, beach, cicada market, thailand, weekend market, art, food, night',
                'what_to_expect' => 'Enjoy a day at the royal resort town of Hua Hin with its long sandy beach, then browse the chic Cicada Night Market with local art, handcrafts, and gourmet street food in the evening.',
                'good_to_know' => 'Cicada Market runs Friday–Sunday evenings. Hua Hin is about 3 hours south of Bangkok by train or bus.',
                'highlights' => 'Hua Hin Beach, royal beach chairs, Cicada Market art and food, Hua Hin Railway Station',
                'start_date' => '2026-01-01',
                'end_date' => '2026-12-31',
                'closing_type' => null,
                'closing_days' => [],
                'countries' => [165],
                'cities' => [8320],
                'categories' => [1],
                'images' => [
                    'https://i.pinimg.com/736x/2d/90/64/2d9064237c1e2fa01b1017a25737ae77.jpg',
                    'https://i.pinimg.com/736x/0d/54/96/0d5496fc4f97559742811ef84f9e3791.jpg',
                ],
                'packages' => [
                    [
                        'name' => 'Hua Hin Day Trip',
                        'description' => 'Full-day trip from Bangkok to Hua Hin beach and evening Cicada Market.',
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 42.00],
                            ['age_group_id' => 2, 'price' => 25.00],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Pai Canyon & Hot Springs Adventure',
                'star_rating' => 4.6,
                'search_keywords' => 'pai, canyon, hot springs, chiang mai, thailand, northern thailand, sunset, trekking',
                'what_to_expect' => 'Explore the charming mountain town of Pai in northern Thailand, trekking along the dramatic ridges of Pai Canyon at sunset and soaking in natural hot springs.',
                'good_to_know' => 'Canyon paths can be slippery — wear proper shoes. Hot springs are best at dusk. Pai is 3 hours from Chiang Mai.',
                'highlights' => 'Pai Canyon sunset, hot springs soak, Pai Town walking street, Mae Yen waterfall, bamboo bridge',
                'start_date' => '2026-10-01',
                'end_date' => '2026-04-30',
                'closing_type' => null,
                'closing_days' => [],
                'countries' => [165],
                'cities' => [601],
                'categories' => [1],
                'images' => [
                    'https://i.pinimg.com/736x/f3/5f/ca/f35fca60a7b28dbd5def45fc2e778db7.jpg',
                    'https://i.pinimg.com/736x/db/59/b9/db59b95a7a1ecde42917f94654967896.jpg',
                ],
                'packages' => [
                    [
                        'name' => '2D1N Pai Adventure Tour',
                        'description' => 'Two-day guided adventure tour to Pai from Chiang Mai with overnight stay.',
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 90.00],
                            ['age_group_id' => 2, 'price' => 65.00],
                        ],
                    ],
                ],
            ],
        ];

        foreach ($products as $data) {
            $product = Product::create([
                'name' => $data['name'],
                'service' => ServiceEnum::ATTRACTION->value,
                'star_rating' => $data['star_rating'],
            ]);

            $noSpaceName = str_replace(' ', '', strtolower($product->name));
            $product->update([
                'slug' => $product->id.'-'.Str::slug($product->name),
                'search_keywords' => "{$noSpaceName}, ".$data['search_keywords'],
            ]);

            $product->detail()->create([
                'what_to_expect' => $data['what_to_expect'],
                'good_to_know' => $data['good_to_know'],
                'highlights' => $data['highlights'],
            ]);

            $product->schedule()->create([
                'start_date' => $data['start_date'],
                'end_date' => $data['end_date'],
                'closing_type' => $data['closing_type'],
                'closing_dates' => [],
                'closing_days' => $data['closing_type'] === ClosingTypeEnum::CLOSING_DAYS->value ? $data['closing_days'] : [],
            ]);

            $product->countries()->sync($data['countries']);
            $product->cities()->sync($data['cities']);
            $product->categories()->sync($data['categories']);

            foreach ($data['images'] as $imageUrl) {
                $product->images()->create(['url' => $imageUrl]);
            }

            foreach ($data['packages'] as $package) {
                $attractionPackage = $product->attractionPackages()->create([
                    'name' => $package['name'],
                    'description' => $package['description'],
                ]);

                foreach ($package['prices'] as $price) {
                    $attractionPackage->prices()->create([
                        'age_group_id' => $price['age_group_id'],
                        'price' => $price['price'],
                    ]);
                }
            }
        }
    }
}
