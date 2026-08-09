<?php

namespace Database\Seeders;

use App\Enums\ClosingTypeEnum;
use App\Enums\ServiceEnum;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
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
                'start_date' => '2026-05-05',
                'end_date' => '2028-05-05',
                'closing_type' => ClosingTypeEnum::CLOSING_DAYS->value,
                'closing_days' => ['Wednesday'],
                'countries' => [152],
                'cities' => [87],
                'categories' => [1],
                'images' => [
                    'https://i.pinimg.com/736x/87/98/2a/87982a235d529bad2d7adefeac778e2d.jpg',
                    'https://i.pinimg.com/736x/95/e8/9a/95e89a04ba635a0f5fdd1aa23e1fb012.jpg',
                    'https://i.pinimg.com/736x/44/6d/75/446d75d2f2d7dadc72791f01d1edcae8.jpg',
                    'https://i.pinimg.com/736x/a2/fb/a4/a2fba432b601cc7d4da6b3cd54d81d4c.jpg',
                    'https://i.pinimg.com/736x/4d/32/10/4d3210d7f0b484234d765939adb20ecd.jpg',
                    'https://i.pinimg.com/736x/ba/45/15/ba45155157e2177b0f267e8250e1ff15.jpg',
                    'https://i.pinimg.com/736x/fc/55/ee/fc55ee776c1c1c35832765665cc11928.jpg',
                    'https://i.pinimg.com/736x/2f/b1/a8/2fb1a8cebb1f53b6716e95662460ef23.jpg',
                    'https://i.pinimg.com/736x/2f/e4/44/2fe4446515632975beab7d321c44fd38.jpg',
                    'https://i.pinimg.com/736x/1e/a5/ba/1ea5bac08512edd38c3c468bb56a8489.jpg',
                ],
                'packages' => [
                    [
                        'name' => 'Standard Day Pass',
                        'description' => <<<'HTML'
                            <div class="space-y-4">
                                <p>Step straight into the movies with a full-day <strong>Standard Day Pass</strong> to Universal Studios Singapore. Your ticket unlocks all seven themed zones on Sentosa Island — from Ancient Egypt and a galaxy far, far away to the streets of New York — with unlimited rides, live shows and street entertainment from the moment the gates open until the last performance of the evening.</p>
                                <img src="https://i.pinimg.com/736x/87/98/2a/87982a235d529bad2d7adefeac778e2d.jpg" alt="Universal Studios Singapore entrance globe" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">What is included</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>One-day admission to all seven themed zones of the park</li>
                                    <li>Unlimited rides on every attraction, including Transformers The Ride and Battlestar Galactica</li>
                                    <li>Access to all daily live shows, parades and character meet-and-greets</li>
                                    <li>Free use of lockers at high-thrill rides and complimentary park Wi-Fi</li>
                                </ul>
                                <h4 class="text-base font-semibold">A typical day</h4>
                                <ol class="list-decimal pl-5 space-y-1">
                                    <li>Arrive 30 minutes before opening and scan your e-ticket straight at the turnstile</li>
                                    <li>Head to Sci-Fi City first while queues are still short</li>
                                    <li>Break for lunch in New York or Ancient Egypt, then catch an afternoon show</li>
                                    <li>Finish with Far Far Away and the Puss In Boots ride as the crowds thin out</li>
                                </ol>
                                <img src="https://i.pinimg.com/736x/44/6d/75/446d75d2f2d7dadc72791f01d1edcae8.jpg" alt="Themed zone inside Universal Studios Singapore" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">Good to know</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Height restrictions apply on several thrill rides — check before queueing with young children</li>
                                    <li>The park is closed on Wednesdays, so plan your visit on any other day of the week</li>
                                    <li>Wear comfortable shoes; expect to walk 6–8 km over a full day</li>
                                    <li>Outside food and drink are not permitted, but there are plenty of dining outlets inside</li>
                                </ul>
                                <p><em>This pass does not include express queue access. If you are visiting on a weekend or public holiday, consider upgrading to the Express Pass.</em></p>
                            </div>
                            HTML,
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 2900.00],
                            ['age_group_id' => 2, 'price' => 2100.00],
                        ],
                    ],
                    [
                        'name' => 'Express Pass',
                        'description' => <<<'HTML'
                            <div class="space-y-4">
                                <p>Make every minute count with the <strong>Universal Express Pass</strong>. On top of full-day park admission, you get a dedicated express lane on the park's most popular attractions — turning a 60-minute wait into a five-minute walk. It is the single best upgrade for weekends, school holidays and anyone who wants to ride everything twice.</p>
                                <img src="https://i.pinimg.com/736x/95/e8/9a/95e89a04ba635a0f5fdd1aa23e1fb012.jpg" alt="Roller coaster at Universal Studios Singapore" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">What is included</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Full-day admission to all seven themed zones</li>
                                    <li>One express entry per participating ride, including Transformers The Ride and Revenge of the Mummy</li>
                                    <li>Priority seating at selected live shows and stage performances</li>
                                    <li>Separate, shaded express queues with dedicated ride hosts</li>
                                </ul>
                                <h4 class="text-base font-semibold">How the express lane works</h4>
                                <ol class="list-decimal pl-5 space-y-1">
                                    <li>Show your express wristband at the ride entrance and follow the express signage</li>
                                    <li>Ride hosts merge express guests into the boarding queue every few cycles</li>
                                    <li>Repeat on every participating attraction — no time-slot booking required</li>
                                </ol>
                                <img src="https://i.pinimg.com/736x/a2/fb/a4/a2fba432b601cc7d4da6b3cd54d81d4c.jpg" alt="Ride queue and themed street at Universal Studios" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">Good to know</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Express Pass quantities are capped daily and sell out fastest on weekends</li>
                                    <li>The pass covers one express ride per attraction, not unlimited re-rides</li>
                                    <li>Same height and health restrictions apply as on standard admission</li>
                                    <li>The park is closed on Wednesdays</li>
                                </ul>
                                <p><em>Best value if you are visiting for a single day and want to experience every major ride without long waits.</em></p>
                            </div>
                            HTML,
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 5200.00],
                            ['age_group_id' => 2, 'price' => 4200.00],
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
                'start_date' => '2026-05-05',
                'end_date' => '2028-05-05',
                'closing_type' => null,
                'closing_days' => [],
                'countries' => [152],
                'cities' => [87],
                'categories' => [1],
                'images' => [
                    'https://i.pinimg.com/1200x/d3/9a/fa/d39afada636e9484e7ad79b6d8602784.jpg',
                    'https://i.pinimg.com/736x/be/30/b1/be30b1c2c2ca395814c123af4eb136a3.jpg',
                    'https://i.pinimg.com/736x/3b/08/a5/3b08a5c7ce57660d90109604555adf4c.jpg',
                    'https://i.pinimg.com/1200x/9f/83/a2/9f83a221ab4a5b37fd9da0fa414cb8c6.jpg',
                    'https://i.pinimg.com/1200x/7e/4d/93/7e4d93c5055c40579b4b866a89ceb94b.jpg',
                    'https://i.pinimg.com/736x/6b/c3/30/6bc3302a15ad18537dc05b279e0d33ba.jpg',
                    'https://i.pinimg.com/736x/09/a0/1b/09a01bcea246b14e519f24fe9cc53aeb.jpg',
                    'https://i.pinimg.com/736x/a3/c2/47/a3c247914d177b43431b5d5c18ce9c78.jpg',
                    'https://i.pinimg.com/1200x/34/b5/a3/34b5a3cbb751fe844502b71822b10fcd.jpg',
                    'https://i.pinimg.com/736x/ed/0f/ef/ed0fef7957e4e953268c167b1f6bc3e0.jpg',
                ],
                'packages' => [
                    [
                        'name' => 'Observation Deck Ticket',
                        'description' => <<<'HTML'
                            <div class="space-y-4">
                                <p>Rise 200 metres above the city to the <strong>SkyPark Observation Deck</strong>, perched on top of Marina Bay Sands. From the cantilevered platform you get an uninterrupted sweep across the Singapore skyline, Gardens by the Bay, the Singapore Strait and the shipping lanes beyond — the single best vantage point in the country.</p>
                                <img src="https://i.pinimg.com/1200x/d3/9a/fa/d39afada636e9484e7ad79b6d8602784.jpg" alt="Marina Bay Sands SkyPark at dusk" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">What is included</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Entry to the SkyPark Observation Deck on level 57</li>
                                    <li>High-speed lift access from the Tower 3 basement</li>
                                    <li>Open-air viewing platform with 360-degree panoramas</li>
                                    <li>Complimentary use of the mounted viewing telescopes</li>
                                </ul>
                                <h4 class="text-base font-semibold">Best times to visit</h4>
                                <ol class="list-decimal pl-5 space-y-1">
                                    <li><strong>Late afternoon</strong> — clear daylight views over the harbour and the CBD</li>
                                    <li><strong>Golden hour</strong> — arrive 45 minutes before sunset for the best photographs</li>
                                    <li><strong>After dark</strong> — the skyline lights up and the Supertrees begin their light show</li>
                                </ol>
                                <img src="https://i.pinimg.com/1200x/9f/83/a2/9f83a221ab4a5b37fd9da0fa414cb8c6.jpg" alt="View of the Singapore skyline from the SkyPark" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">Good to know</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>The famous infinity pool is reserved for hotel guests — the observation deck is a separate area</li>
                                    <li>The deck may close briefly during thunderstorms or high winds</li>
                                    <li>Allow around one hour for a relaxed visit</li>
                                    <li>Tripods and large camera rigs are not permitted on the deck</li>
                                </ul>
                                <p><em>Sunset time slots are the most popular and often sell out days in advance — book early if you want that window.</em></p>
                            </div>
                            HTML,
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 1100.00],
                            ['age_group_id' => 2, 'price' => 750.00],
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
                'start_date' => '2026-05-05',
                'end_date' => '2028-05-05',
                'closing_type' => ClosingTypeEnum::CLOSING_DAYS->value,
                'closing_days' => ['Sunday'],
                'countries' => [165],
                'cities' => [7024],
                'categories' => [1],
                'images' => [
                    'https://i.pinimg.com/1200x/0f/2a/6d/0f2a6d2416feecc4788b45808231800d.jpg',
                    'https://i.pinimg.com/1200x/2e/17/89/2e17893f3bef3a401d1a93bf8b41ecfd.jpg',
                    'https://i.pinimg.com/736x/7f/0b/ed/7f0bed71f51dc8e9edecf6899ecceb55.jpg',
                    'https://i.pinimg.com/1200x/37/7b/49/377b4985467fae05b18edbb4885fa36e.jpg',
                    'https://i.pinimg.com/1200x/4d/a6/7b/4da67b931c130fd658c14aa254309c0f.jpg',
                    'https://i.pinimg.com/1200x/86/b0/92/86b092b7f02b86d025c7938d1f8ab4b5.jpg',
                    'https://i.pinimg.com/736x/2f/ef/e8/2fefe84fd51e29163bd21c06b6ec56f3.jpg',
                    'https://i.pinimg.com/736x/f7/c4/cd/f7c4cdbb4a3b249c370c2d8b0eb9a0ed.jpg',
                    'https://i.pinimg.com/736x/3d/96/c2/3d96c213a74d5a008986d0e1aa123e29.jpg',
                    'https://i.pinimg.com/1200x/b0/60/bc/b060bc68c5a6321a7612971f047d3c9f.jpg',
                ],
                'packages' => [
                    [
                        'name' => 'Shared Speedboat Tour',
                        'description' => <<<'HTML'
                            <div class="space-y-4">
                                <p>Spend a full day island-hopping around the Phi Phi archipelago on a <strong>shared speedboat tour</strong>. Travelling in a small group of up to 25 guests, you will cut across the Andaman Sea to Maya Bay, drift into the emerald water of Pileh Lagoon, snorkel over living reef and pull up alongside Monkey Beach — all in a single day.</p>
                                <img src="https://i.pinimg.com/1200x/0f/2a/6d/0f2a6d2416feecc4788b45808231800d.jpg" alt="Longtail boats moored at Phi Phi Island" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">What is included</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Hotel pick-up and drop-off within Phuket town and the main beach areas</li>
                                    <li>Round-trip speedboat transfer with an English-speaking guide</li>
                                    <li>Snorkelling mask, fins and life jacket</li>
                                    <li>Buffet lunch on Phi Phi Don, soft drinks, fresh fruit and towels</li>
                                    <li>National park entrance fees and boat insurance</li>
                                </ul>
                                <h4 class="text-base font-semibold">Your itinerary</h4>
                                <ol class="list-decimal pl-5 space-y-1">
                                    <li>07:30 — pick-up from your hotel and transfer to the pier</li>
                                    <li>09:00 — depart for Bamboo Island and the first snorkelling stop</li>
                                    <li>11:00 — Pileh Lagoon, Viking Cave and Monkey Beach</li>
                                    <li>12:30 — buffet lunch and free time on Phi Phi Don</li>
                                    <li>14:30 — Maya Bay viewpoint, then return to Phuket by around 16:30</li>
                                </ol>
                                <img src="https://i.pinimg.com/1200x/4d/a6/7b/4da67b931c130fd658c14aa254309c0f.jpg" alt="Turquoise water and limestone cliffs at Phi Phi" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">Good to know</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Bring reef-safe sunscreen, a hat and a change of dry clothes</li>
                                    <li>Seasickness tablets are worth taking 30 minutes before departure in choppier months</li>
                                    <li>The tour does not run on Sundays</li>
                                    <li>Swimming at Maya Bay itself is restricted to protect the recovering coral</li>
                                </ul>
                                <p><em>Itineraries may be reordered or shortened depending on sea conditions and park regulations on the day.</em></p>
                            </div>
                            HTML,
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 2300.00],
                            ['age_group_id' => 2, 'price' => 1600.00],
                        ],
                    ],
                    [
                        'name' => 'Private Speedboat Charter',
                        'description' => <<<'HTML'
                            <div class="space-y-4">
                                <p>Charter the whole boat. The <strong>Private Speedboat Charter</strong> gives your group exclusive use of a speedboat, captain and guide for the full day, so you set the pace and the route. Reach Maya Bay before the day-tripper fleet arrives, linger at the snorkelling spots you like, and skip the ones you do not.</p>
                                <img src="https://i.pinimg.com/1200x/2e/17/89/2e17893f3bef3a401d1a93bf8b41ecfd.jpg" alt="Private speedboat anchored off Phi Phi" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">What is included</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Exclusive use of a speedboat for up to 20 guests with captain and crew</li>
                                    <li>Private English-speaking guide for your group only</li>
                                    <li>Flexible departure time and a route planned with you the day before</li>
                                    <li>Snorkelling equipment, life jackets, towels, chilled drinks and fresh fruit</li>
                                    <li>Seafood lunch, national park fees and private hotel transfers</li>
                                </ul>
                                <h4 class="text-base font-semibold">Where you can go</h4>
                                <ol class="list-decimal pl-5 space-y-1">
                                    <li>Maya Bay and Loh Samah Bay at first light, well ahead of the crowds</li>
                                    <li>Pileh Lagoon for swimming in still, jade-green water</li>
                                    <li>Bamboo Island and Mosquito Island for the clearest snorkelling</li>
                                    <li>Monkey Beach, Viking Cave and a lunch stop of your choosing on Phi Phi Don</li>
                                </ol>
                                <img src="https://i.pinimg.com/1200x/86/b0/92/86b092b7f02b86d025c7938d1f8ab4b5.jpg" alt="Aerial view of Phi Phi islands" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">Good to know</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Priced per boat, not per person — the best value for families and groups of six or more</li>
                                    <li>Early departures around 06:30 are strongly recommended for an empty Maya Bay</li>
                                    <li>The charter does not operate on Sundays</li>
                                    <li>Special dietary requirements can be arranged with 48 hours notice</li>
                                </ul>
                                <p><em>Your guide will confirm the final route by phone the evening before, taking the forecast and tides into account.</em></p>
                            </div>
                            HTML,
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 7700.00],
                            ['age_group_id' => 2, 'price' => 7700.00],
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
                'start_date' => '2026-05-05',
                'end_date' => '2028-05-05',
                'closing_type' => null,
                'closing_days' => [],
                'countries' => [165],
                'cities' => [17],
                'categories' => [1],
                'images' => [
                    'https://i.pinimg.com/736x/12/2d/64/122d644598dbcb4e94174c9bd8ce9a1c.jpg',
                    'https://i.pinimg.com/736x/81/d1/f1/81d1f1f4fd78cecdbf69c7dca5cefad3.jpg',
                    'https://i.pinimg.com/736x/a4/69/08/a4690838c6ac92202e5b32222a683510.jpg',
                    'https://i.pinimg.com/736x/10/1d/a3/101da368d5e6684b814fcf753841014a.jpg',
                    'https://i.pinimg.com/736x/ef/9a/9d/ef9a9db987231eeb1845a89c5b561d0d.jpg',
                    'https://i.pinimg.com/736x/fc/14/6c/fc146cd5959cd10b0c1859fe8894b908.jpg',
                    'https://i.pinimg.com/736x/04/8a/a5/048aa5a96067f85c276fa30fbe5c60cd.jpg',
                    'https://i.pinimg.com/736x/fd/3d/13/fd3d1389efa936e6a079d444dde57362.jpg',
                    'https://i.pinimg.com/736x/c5/a4/84/c5a48447327b3ef235bfcc83a53e064b.jpg',
                    'https://i.pinimg.com/736x/17/e7/70/17e7707edb8f75a116907d174cef1ceb.jpg',
                ],
                'packages' => [
                    [
                        'name' => 'Full Day Experience',
                        'description' => <<<'HTML'
                            <div class="space-y-4">
                                <p>Spend a full day inside a genuine elephant sanctuary in the hills outside Chiang Mai. There is <strong>no riding, no bathing shows and no hooks</strong> — instead you prepare food, feed the herd by hand, walk with them to the river and hear the rescue story behind every animal from the mahouts who care for them.</p>
                                <img src="https://i.pinimg.com/736x/12/2d/64/122d644598dbcb4e94174c9bd8ce9a1c.jpg" alt="Rescued elephants at a Chiang Mai sanctuary" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">What is included</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Round-trip minivan transfer from central Chiang Mai</li>
                                    <li>Full-day programme with an English-speaking guide and the resident mahouts</li>
                                    <li>Elephant food preparation and hand-feeding session</li>
                                    <li>Vegetarian buffet lunch, drinking water, coffee and seasonal fruit</li>
                                    <li>Sanctuary clothing to borrow, plus showers and changing rooms</li>
                                </ul>
                                <h4 class="text-base font-semibold">Your day at the park</h4>
                                <ol class="list-decimal pl-5 space-y-1">
                                    <li>08:00 — hotel pick-up and a scenic drive into the Mae Taeng valley</li>
                                    <li>09:30 — safety briefing, then chop bananas and pumpkin for the herd</li>
                                    <li>10:00 — hand-feed the elephants and meet each one by name</li>
                                    <li>12:00 — vegetarian buffet lunch overlooking the valley</li>
                                    <li>13:30 — walk with the herd to the river and observe them bathing naturally</li>
                                    <li>16:00 — return to Chiang Mai by around 17:30</li>
                                </ol>
                                <img src="https://i.pinimg.com/736x/a4/69/08/a4690838c6ac92202e5b32222a683510.jpg" alt="Elephant walking through the jungle" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">Good to know</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Wear clothes you do not mind getting muddy, and closed shoes with grip</li>
                                    <li>Riding is never offered — this is a strictly observation-and-care programme</li>
                                    <li>Elephants are free-roaming, so the day follows their mood rather than a fixed script</li>
                                    <li>Suitable for children aged five and above when accompanied by an adult</li>
                                </ul>
                                <p><em>Your booking directly funds veterinary care, land lease and mahout wages at the sanctuary.</em></p>
                            </div>
                            HTML,
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 2800.00],
                            ['age_group_id' => 2, 'price' => 2100.00],
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
                'start_date' => '2026-05-05',
                'end_date' => '2028-05-05',
                'closing_type' => null,
                'closing_days' => [],
                'countries' => [83],
                'cities' => [1],
                'categories' => [1],
                'images' => [
                    'https://i.pinimg.com/736x/93/9d/0a/939d0acf20f09ee7f3c8a02ab97f2263.jpg',
                    'https://i.pinimg.com/736x/a1/f7/5f/a1f75f26d6c214677e958aff56a25ee0.jpg',
                    'https://i.pinimg.com/736x/07/27/2d/07272df566fd504f2061ab10a6f96e0c.jpg',
                    'https://i.pinimg.com/736x/e1/0a/b2/e10ab2ef4e73f907d144ce60e71fcca2.jpg',
                    'https://i.pinimg.com/736x/b9/1c/09/b91c09e04c0ff8f7be350945a8796072.jpg',
                    'https://i.pinimg.com/736x/0c/42/96/0c4296c3f315def1b3f83a82383f3841.jpg',
                    'https://i.pinimg.com/736x/57/02/3a/57023aa5816661bd2fad57985a20f5b1.jpg',
                    'https://i.pinimg.com/736x/b3/94/25/b39425df71e5f8830e5505d1698ddc54.jpg',
                    'https://i.pinimg.com/736x/8d/8f/2d/8d8f2d6b6cc5afc1c618c0256bf75eae.jpg',
                    'https://i.pinimg.com/736x/6c/1d/3b/6c1d3bd4f9b3b3a69dbb4420d63160b0.jpg',
                ],
                'packages' => [
                    [
                        'name' => '1-Day Passport',
                        'description' => <<<'HTML'
                            <div class="space-y-4">
                                <p>The <strong>1-Day Passport</strong> gives you the run of Tokyo DisneySea — the only park of its kind in the world. Seven themed ports circle a volcano and a Venetian harbour, blending Disney storytelling with genuinely world-class themed architecture. It is regularly rated the best theme park on the planet, and a single day is only just enough.</p>
                                <img src="https://i.pinimg.com/736x/93/9d/0a/939d0acf20f09ee7f3c8a02ab97f2263.jpg" alt="Mount Prometheus at Tokyo DisneySea" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">What is included</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>One-day admission to all seven themed ports</li>
                                    <li>Unlimited rides on every attraction, including Tower of Terror and Journey to the Center of the Earth</li>
                                    <li>All daytime and evening entertainment, including the harbour shows</li>
                                    <li>Access to the in-park app for real-time wait times and standby passes</li>
                                </ul>
                                <h4 class="text-base font-semibold">The seven ports</h4>
                                <ol class="list-decimal pl-5 space-y-1">
                                    <li><strong>Mediterranean Harbor</strong> — Venetian canals, gondolas and the nightly show</li>
                                    <li><strong>Mysterious Island</strong> — inside the volcano, home to two headline rides</li>
                                    <li><strong>Mermaid Lagoon</strong> — a fully indoor undersea world, ideal for younger children</li>
                                    <li><strong>Arabian Coast, Lost River Delta, Port Discovery and American Waterfront</strong> — the rest of the loop</li>
                                </ol>
                                <img src="https://i.pinimg.com/736x/07/27/2d/07272df566fd504f2061ab10a6f96e0c.jpg" alt="Venetian gondolas at Tokyo DisneySea" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">Good to know</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Book well ahead — dated tickets sell out weeks in advance in peak season</li>
                                    <li>Weekends and Japanese public holidays are extremely busy; weekdays are far calmer</li>
                                    <li>Download the official app before you arrive and enable Japanese-region access</li>
                                    <li>The park stays open late — stay for the harbour show rather than leaving at dusk</li>
                                </ul>
                                <p><em>Standby passes for the newest attractions are released in the app at park opening and go fast.</em></p>
                            </div>
                            HTML,
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 2500.00],
                            ['age_group_id' => 2, 'price' => 2000.00],
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
                'start_date' => '2026-05-05',
                'end_date' => '2028-05-05',
                'closing_type' => null,
                'closing_days' => [],
                'countries' => [83],
                'cities' => [1],
                'categories' => [1],
                'images' => [
                    'https://i.pinimg.com/736x/cc/2a/49/cc2a4986cc8e45a854da141385045ee4.jpg',
                    'https://i.pinimg.com/736x/d2/14/e2/d214e22fbdc22dcf28e7460a73c2213f.jpg',
                    'https://i.pinimg.com/736x/fd/26/67/fd2667de80e88f8035c49c82ab501469.jpg',
                    'https://i.pinimg.com/736x/cc/d3/f4/ccd3f4cff2007085f35e7fb16b411134.jpg',
                    'https://i.pinimg.com/736x/8a/6c/01/8a6c01a575bf3d676a2a89c2e72ffd0f.jpg',
                    'https://i.pinimg.com/736x/49/1b/3b/491b3b051756d3dcb5af188f91da22d9.jpg',
                    'https://i.pinimg.com/736x/67/76/8b/67768be6df2635fddbbc71210ad6d477.jpg',
                    'https://i.pinimg.com/736x/7e/08/f6/7e08f6381635864859b7252262191f84.jpg',
                    'https://i.pinimg.com/736x/2e/15/6e/2e156ee4712b4496b6b6c00fcc43a9b3.jpg',
                    'https://i.pinimg.com/736x/a8/96/14/a89614bb836d3e3c392db251d103f1b8.jpg',
                ],
                'packages' => [
                    [
                        'name' => 'Guided Day Tour',
                        'description' => <<<'HTML'
                            <div class="space-y-4">
                                <p>Escape Tokyo for a day and get close to Japan's most famous mountain. This <strong>guided day tour</strong> takes you up to the Fuji Fifth Station, around the shores of Lake Kawaguchiko and through the Fuji Five Lakes region, with a local guide explaining the volcano's history and its place in Japanese culture along the way.</p>
                                <img src="https://i.pinimg.com/736x/cc/2a/49/cc2a4986cc8e45a854da141385045ee4.jpg" alt="Mount Fuji seen across Lake Kawaguchiko" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">What is included</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Air-conditioned coach transport from central Tokyo and back</li>
                                    <li>English-speaking guide for the full day</li>
                                    <li>Traditional Japanese lunch</li>
                                    <li>Ropeway ticket at Lake Kawaguchiko and all listed entrance fees</li>
                                </ul>
                                <h4 class="text-base font-semibold">Your itinerary</h4>
                                <ol class="list-decimal pl-5 space-y-1">
                                    <li>08:00 — depart Shinjuku by coach</li>
                                    <li>10:00 — Mount Fuji Fifth Station at 2,300 m, the highest point reachable by road</li>
                                    <li>12:00 — Japanese set lunch near the lakes</li>
                                    <li>13:30 — Lake Kawaguchiko, ropeway and the classic Fuji viewpoint</li>
                                    <li>15:00 — Oshino Hakkai spring village, then return to Tokyo by around 19:00</li>
                                </ol>
                                <img src="https://i.pinimg.com/736x/fd/26/67/fd2667de80e88f8035c49c82ab501469.jpg" alt="Mount Fuji with cherry blossom" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">Good to know</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Mountain views depend entirely on the weather — winter and early morning offer the clearest skies</li>
                                    <li>The Fifth Station is roughly 15°C colder than Tokyo; bring a jacket in every season</li>
                                    <li>The road to the Fifth Station closes in heavy snow, and the tour then substitutes a lower viewpoint</li>
                                    <li>The official climbing season runs from July to September only</li>
                                </ul>
                                <p><em>This is a sightseeing tour, not a climb — no hiking experience or special equipment is needed.</em></p>
                            </div>
                            HTML,
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 3300.00],
                            ['age_group_id' => 2, 'price' => 2300.00],
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
                'start_date' => '2026-05-05',
                'end_date' => '2028-05-05',
                'closing_type' => null,
                'closing_days' => [],
                'countries' => [200],
                'cities' => [221],
                'categories' => [1],
                'images' => [
                    'https://i.pinimg.com/736x/f2/a4/08/f2a4087b98c46746840cc08a2b0db387.jpg',
                    'https://i.pinimg.com/736x/6d/05/a8/6d05a8d914216c448d17ace87f3a871d.jpg',
                    'https://i.pinimg.com/736x/eb/bf/03/ebbf036443f4d52584b99482deb1aa24.jpg',
                    'https://i.pinimg.com/736x/1c/8d/83/1c8d83008a4d6c7090ee4608ac5d0885.jpg',
                    'https://i.pinimg.com/736x/8c/91/e3/8c91e3a1a4bfc2b0b3c5c8b533c79b58.jpg',
                    'https://i.pinimg.com/736x/95/10/0e/95100e6bbb4e0728dbb90a5033802b73.jpg',
                    'https://i.pinimg.com/736x/21/83/92/218392fa3ff059c6c8908c47089d3585.jpg',
                    'https://i.pinimg.com/736x/56/99/88/5699889649264aeea0ff63a28f197ede.jpg',
                    'https://i.pinimg.com/736x/94/e5/7a/94e57a7968b5a7cfef0ca80cf720dcf3.jpg',
                    'https://i.pinimg.com/736x/60/26/69/6026695dccfaeeb93ebaf6b9d97c345f.jpg',
                ],
                'packages' => [
                    [
                        'name' => 'Evening Desert Safari',
                        'description' => <<<'HTML'
                            <div class="space-y-4">
                                <p>Trade the skyscrapers for sand dunes on a classic <strong>evening desert safari</strong>. A 4x4 collects you from your hotel in the afternoon, throws itself over the red dunes of the Lahbab desert, then delivers you to a Bedouin-style camp for a barbecue dinner, live entertainment and a sky full of stars.</p>
                                <img src="https://i.pinimg.com/736x/f2/a4/08/f2a4087b98c46746840cc08a2b0db387.jpg" alt="4x4 dune bashing in the Dubai desert" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">What is included</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Hotel pick-up and drop-off in a shared 4x4 (six guests per vehicle)</li>
                                    <li>45 minutes of dune bashing with an experienced desert driver</li>
                                    <li>Camel ride, sandboarding and a desert sunset photo stop</li>
                                    <li>Buffet BBQ dinner with vegetarian options, soft drinks, tea and coffee</li>
                                    <li>Belly dance, tanoura and fire shows, plus henna painting and shisha</li>
                                </ul>
                                <h4 class="text-base font-semibold">How the evening runs</h4>
                                <ol class="list-decimal pl-5 space-y-1">
                                    <li>15:00 — pick-up from your hotel and drive to the desert edge</li>
                                    <li>16:00 — tyre deflation, then dune bashing across the red dunes</li>
                                    <li>17:30 — sunset photo stop, camel rides and sandboarding</li>
                                    <li>18:30 — arrive at camp for henna, shisha and the show programme</li>
                                    <li>20:00 — BBQ buffet dinner under the stars, returning by around 21:30</li>
                                </ol>
                                <img src="https://i.pinimg.com/736x/eb/bf/03/ebbf036443f4d52584b99482deb1aa24.jpg" alt="Bedouin desert camp at night" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">Good to know</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Not recommended during pregnancy or for guests with back, neck or heart conditions</li>
                                    <li>Dress modestly at the camp — shoulders and knees covered</li>
                                    <li>Desert evenings get cold from November to February; bring a light jacket</li>
                                    <li>Alcoholic drinks are available at the camp for an additional charge</li>
                                </ul>
                                <p><em>Guests who prefer to skip the dune bashing can request a direct camp transfer at no extra cost.</em></p>
                            </div>
                            HTML,
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 1900.00],
                            ['age_group_id' => 2, 'price' => 1200.00],
                        ],
                    ],
                    [
                        'name' => 'VIP Desert Safari',
                        'description' => <<<'HTML'
                            <div class="space-y-4">
                                <p>The <strong>VIP Desert Safari</strong> replaces the crowded coach-party camp with something quieter and considerably more comfortable: a private 4x4, a smaller camp with reserved majlis seating, and a plated gourmet dinner served rather than queued for. Same dunes, same sunset, far fewer people.</p>
                                <img src="https://i.pinimg.com/736x/6d/05/a8/6d05a8d914216c448d17ace87f3a871d.jpg" alt="Luxury desert camp setup in Dubai" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">What is included</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Private 4x4 with a dedicated driver-guide for your party only</li>
                                    <li>Extended dune bashing session and a private sunset stop away from the convoys</li>
                                    <li>Reserved VIP majlis seating with cushions, carpets and table service</li>
                                    <li>Gourmet plated dinner with premium grills, mezze and live cooking stations</li>
                                    <li>Falconry display, camel ride, sandboarding, henna and unlimited soft drinks</li>
                                </ul>
                                <h4 class="text-base font-semibold">How the evening runs</h4>
                                <ol class="list-decimal pl-5 space-y-1">
                                    <li>15:30 — private pick-up at a time that suits you</li>
                                    <li>16:30 — dune bashing, then a falconry demonstration on the open sand</li>
                                    <li>17:45 — private sunset stop with refreshments and photographs</li>
                                    <li>19:00 — arrive at the VIP camp for the show programme and plated dinner</li>
                                    <li>22:00 — unhurried return to your hotel</li>
                                </ol>
                                <img src="https://i.pinimg.com/736x/95/10/0e/95100e6bbb4e0728dbb90a5033802b73.jpg" alt="Sunset over the Dubai desert dunes" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">Good to know</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Not recommended during pregnancy or for guests with back, neck or heart conditions</li>
                                    <li>Dietary requirements including halal, vegan and gluten-free can be arranged in advance</li>
                                    <li>Modest dress is required inside the camp</li>
                                    <li>Bring a light jacket between November and February</li>
                                </ul>
                                <p><em>Ideal for honeymooners, families and anyone who wants the desert experience without the coach-tour crowds.</em></p>
                            </div>
                            HTML,
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 4500.00],
                            ['age_group_id' => 2, 'price' => 3500.00],
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
                'start_date' => '2026-05-05',
                'end_date' => '2028-05-05',
                'closing_type' => null,
                'closing_days' => [],
                'countries' => [200],
                'cities' => [221],
                'categories' => [1],
                'images' => [
                    'https://i.pinimg.com/736x/88/ec/56/88ec56143aad7770e1617be1ff847628.jpg',
                    'https://i.pinimg.com/736x/9e/06/14/9e0614673e0baf526c50977875ba9d20.jpg',
                    'https://i.pinimg.com/736x/42/8c/8a/428c8a5eb091937a6d0709eee58f61a4.jpg',
                    'https://i.pinimg.com/736x/f9/dc/2b/f9dc2b954abf54121cf188c1383c1afb.jpg',
                    'https://i.pinimg.com/736x/06/97/74/069774aef341a74926286af8cbc05406.jpg',
                    'https://i.pinimg.com/736x/4f/d8/a7/4fd8a740358f0d57d41703e8d7015090.jpg',
                    'https://i.pinimg.com/736x/2d/a9/d6/2da9d658e798a8ecd9b6e67cd51a130d.jpg',
                    'https://i.pinimg.com/736x/2c/fc/21/2cfc21d1138eac4cd5d56e40a8d0008b.jpg',
                    'https://i.pinimg.com/736x/ab/2e/15/ab2e15d7c590b44d6c4731c85a88aeb2.jpg',
                    'https://i.pinimg.com/736x/0a/50/55/0a5055fdbefe76025a3d75bdcd246e61.jpg',
                ],
                'packages' => [
                    [
                        'name' => 'At The Top (124th Floor)',
                        'description' => <<<'HTML'
                            <div class="space-y-4">
                                <p>Ride one of the world's fastest lifts to the <strong>124th floor of the Burj Khalifa</strong> and step out onto At The Top — the observation deck that made Dubai's skyline famous. The floor-to-ceiling glass and outdoor terrace give you an uninterrupted view over the Palm, the Gulf coast and the desert beyond.</p>
                                <img src="https://i.pinimg.com/736x/88/ec/56/88ec56143aad7770e1617be1ff847628.jpg" alt="Burj Khalifa rising above Dubai" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">What is included</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Timed-entry admission to the level 124 observation deck</li>
                                    <li>High-speed lift travelling at 10 metres per second</li>
                                    <li>Access to the outdoor viewing terrace and the interactive Behold telescopes</li>
                                    <li>Multimedia exhibition on the tower's construction on the way up</li>
                                </ul>
                                <h4 class="text-base font-semibold">What you will see</h4>
                                <ol class="list-decimal pl-5 space-y-1">
                                    <li>The Dubai Fountain and Downtown Dubai directly below</li>
                                    <li>Palm Jumeirah and the Gulf coastline to the west</li>
                                    <li>The Arabian desert stretching away to the south</li>
                                    <li>Sheikh Zayed Road and the Marina skyline in one continuous sweep</li>
                                </ol>
                                <img src="https://i.pinimg.com/736x/42/8c/8a/428c8a5eb091937a6d0709eee58f61a4.jpg" alt="View of Dubai from the Burj Khalifa observation deck" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">Good to know</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Entry is by timed slot — arrive 15 minutes before the time printed on your ticket</li>
                                    <li>Sunset slots carry a premium and sell out first</li>
                                    <li>Allow 60–90 minutes including security and lift queues</li>
                                    <li>The outdoor terrace may close in high wind or sandstorms</li>
                                </ul>
                                <p><em>Entry is through the lower ground floor of The Dubai Mall — follow the At The Top signage.</em></p>
                            </div>
                            HTML,
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 1400.00],
                            ['age_group_id' => 2, 'price' => 900.00],
                        ],
                    ],
                    [
                        'name' => 'At The Top Sky (148th Floor)',
                        'description' => <<<'HTML'
                            <div class="space-y-4">
                                <p><strong>At The Top Sky</strong> takes you 555 metres up to level 148 — the highest observation deck in the building and, for a long time, the highest in the world. The experience is deliberately unhurried: a private lounge, refreshments served at your seat, a guided introduction, and then the level 125 and 124 decks on your way back down.</p>
                                <img src="https://i.pinimg.com/736x/9e/06/14/9e0614673e0baf526c50977875ba9d20.jpg" alt="Burj Khalifa at night" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">What is included</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Priority entry with a separate, faster security and check-in lane</li>
                                    <li>Access to the level 148 SKY lounge with a personal guide</li>
                                    <li>Refreshments and light bites served in the lounge</li>
                                    <li>Continued access to the level 125 and 124 observation decks</li>
                                    <li>Outdoor terrace access and a complimentary souvenir photograph</li>
                                </ul>
                                <h4 class="text-base font-semibold">How the visit flows</h4>
                                <ol class="list-decimal pl-5 space-y-1">
                                    <li>Check in at the dedicated SKY reception in The Dubai Mall</li>
                                    <li>Ride the express lift directly to level 148 with a guide</li>
                                    <li>Enjoy the lounge, terrace and refreshments at your own pace</li>
                                    <li>Descend to levels 125 and 124 and stay as long as you like</li>
                                </ol>
                                <img src="https://i.pinimg.com/736x/f9/dc/2b/f9dc2b954abf54121cf188c1383c1afb.jpg" alt="Aerial view over Dubai from the Burj Khalifa" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">Good to know</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Capacity on level 148 is strictly limited — book several days ahead</li>
                                    <li>Allow around two hours for the full experience</li>
                                    <li>Smart casual dress is expected in the SKY lounge</li>
                                    <li>Sunset slots are the most sought after and priced accordingly</li>
                                </ul>
                                <p><em>The best-value time to book is roughly 45 minutes before sunset — you get daylight, golden hour and the lit-up city in one visit.</em></p>
                            </div>
                            HTML,
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 4200.00],
                            ['age_group_id' => 2, 'price' => 3200.00],
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
                'start_date' => '2026-05-05',
                'end_date' => '2028-05-05',
                'closing_type' => null,
                'closing_days' => [],
                'countries' => [78],
                'cities' => [87],
                'categories' => [1],
                'images' => [
                    'https://i.pinimg.com/736x/69/a5/5b/69a55b312104bfeb8d4abb587ceb066b.jpg',
                    'https://i.pinimg.com/736x/a1/59/b4/a159b434d344150956b36522b38aa884.jpg',
                    'https://i.pinimg.com/736x/2e/2e/08/2e2e08bc2d936a30df5bf317cfedb0c9.jpg',
                    'https://i.pinimg.com/736x/93/10/ea/9310ea1c987b8208c26e75f4a81f6010.jpg',
                    'https://i.pinimg.com/736x/6d/0f/9a/6d0f9ae9560d18f63e25e09e2a555d96.jpg',
                    'https://i.pinimg.com/736x/31/3f/cc/313fcc24dc30548e98e8a4e2772055f9.jpg',
                    'https://i.pinimg.com/736x/a7/d6/70/a7d6702357c342b1982acbc0ee8c1475.jpg',
                    'https://i.pinimg.com/736x/71/e3/66/71e366b92177426db1e584757e41e29e.jpg',
                    'https://i.pinimg.com/736x/d4/31/5a/d4315a651f97093d8de5d3687f3cb71e.jpg',
                    'https://i.pinimg.com/736x/fa/78/7c/fa787c2af188e12eb70701dc2f7c9561.jpg',
                ],
                'packages' => [
                    [
                        'name' => 'Full Day Ubud Tour',
                        'description' => <<<'HTML'
                            <div class="space-y-4">
                                <p>A full day through the cultural heart of Bali. This <strong>Ubud tour</strong> links the Sacred Monkey Forest, the terraced rice fields of Tegallalang and the holy spring temple of Tirta Empul, with a driver-guide who knows the back roads and the right times to arrive at each stop.</p>
                                <img src="https://i.pinimg.com/736x/69/a5/5b/69a55b312104bfeb8d4abb587ceb066b.jpg" alt="Tegallalang rice terraces in Ubud" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">What is included</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Private air-conditioned car with an English-speaking driver-guide</li>
                                    <li>Hotel pick-up and drop-off across Ubud, Seminyak, Kuta and Canggu</li>
                                    <li>All entrance fees, parking and a sarong to borrow for temple visits</li>
                                    <li>Balinese lunch at a restaurant overlooking the rice terraces</li>
                                    <li>Bottled water and fuel</li>
                                </ul>
                                <h4 class="text-base font-semibold">Your itinerary</h4>
                                <ol class="list-decimal pl-5 space-y-1">
                                    <li>08:30 — hotel pick-up and drive north into the highlands</li>
                                    <li>10:00 — Sacred Monkey Forest Sanctuary and its moss-covered temples</li>
                                    <li>11:30 — Tegallalang rice terraces, with time for the swings and viewpoints</li>
                                    <li>13:00 — Balinese lunch with a valley view</li>
                                    <li>14:30 — Pura Tirta Empul holy spring temple and purification pools</li>
                                    <li>16:00 — Ubud art market and palace, returning by around 18:00</li>
                                </ol>
                                <img src="https://i.pinimg.com/736x/2e/2e/08/2e2e08bc2d936a30df5bf317cfedb0c9.jpg" alt="Balinese temple gate in Ubud" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">Good to know</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Shoulders and knees must be covered inside temples — a sarong is provided</li>
                                    <li>Do not carry food or loose items in the Monkey Forest; the macaques are quick</li>
                                    <li>Paths can be slippery in the rainy season, so wear shoes with grip</li>
                                    <li>The order of stops can be adjusted on the day to avoid the biggest crowds</li>
                                </ul>
                                <p><em>Bring a small amount of cash for the optional rice-terrace swings and market purchases.</em></p>
                            </div>
                            HTML,
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 1750.00],
                            ['age_group_id' => 2, 'price' => 1050.00],
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
                'start_date' => '2026-05-05',
                'end_date' => '2028-05-05',
                'closing_type' => ClosingTypeEnum::CLOSING_DAYS->value,
                'closing_days' => ['Monday'],
                'countries' => [101],
                'cities' => [48],
                'categories' => [1],
                'images' => [
                    'https://i.pinimg.com/736x/3e/8f/e5/3e8fe57916bc1e3b57714cf67110ebd9.jpg',
                    'https://i.pinimg.com/736x/80/1c/81/801c8112578d0771cfe5c85b6f540808.jpg',
                    'https://i.pinimg.com/736x/fb/8f/0f/fb8f0f4e7a8a92a7e9a3a87b430e3253.jpg',
                    'https://i.pinimg.com/736x/64/8a/c1/648ac1d92f94000440ab5c18cdf263b6.jpg',
                    'https://i.pinimg.com/736x/f2/73/0d/f2730d96675236374f9fad29e357cf52.jpg',
                    'https://i.pinimg.com/736x/af/db/10/afdb1000048008c3a0bdbd64abdaf5bb.jpg',
                    'https://i.pinimg.com/736x/f4/81/67/f48167320ac5fad451a5f0c64c2cd38a.jpg',
                    'https://i.pinimg.com/736x/c2/65/7e/c2657efc1da9825d5e70467375f57370.jpg',
                    'https://i.pinimg.com/736x/77/2a/0e/772a0ebdb417aad2fa99573f17af36e6.jpg',
                    'https://i.pinimg.com/736x/39/24/46/39244688d50a81cbd50eb19c6f67d245.jpg',
                ],
                'packages' => [
                    [
                        'name' => 'Sky Bridge + Observation Deck',
                        'description' => <<<'HTML'
                            <div class="space-y-4">
                                <p>Go inside Kuala Lumpur's most recognisable landmark. This ticket covers both levels of the <strong>Petronas Twin Towers</strong> visitor experience: the double-decker Sky Bridge suspended between the towers at level 41, and the observation deck 45 floors higher at level 86.</p>
                                <img src="https://i.pinimg.com/736x/3e/8f/e5/3e8fe57916bc1e3b57714cf67110ebd9.jpg" alt="Petronas Twin Towers in Kuala Lumpur" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">What is included</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Timed-entry ticket to the Sky Bridge on level 41</li>
                                    <li>Continued access to the observation deck on level 86</li>
                                    <li>Introductory film and exhibition on the towers' design and construction</li>
                                    <li>Lift transfers between all levels</li>
                                </ul>
                                <h4 class="text-base font-semibold">How the visit works</h4>
                                <ol class="list-decimal pl-5 space-y-1">
                                    <li>Collect your pass at the concourse level ticket counter beneath the towers</li>
                                    <li>Watch the short orientation film, then take the lift to level 41</li>
                                    <li>Spend around 10 minutes on the Sky Bridge — the group is timed</li>
                                    <li>Continue up to level 86 for the full city panorama and the souvenir shop</li>
                                </ol>
                                <img src="https://i.pinimg.com/736x/fb/8f/0f/fb8f0f4e7a8a92a7e9a3a87b430e3253.jpg" alt="Sky Bridge connecting the Petronas Towers" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">Good to know</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Daily ticket numbers are strictly capped — book at least a day in advance</li>
                                    <li>The towers are closed to visitors on Mondays</li>
                                    <li>Arrive 20 minutes before your slot; late arrivals cannot be admitted</li>
                                    <li>Photography is permitted throughout, tripods are not</li>
                                </ul>
                                <p><em>The whole visit takes roughly 90 minutes. Afterwards, KLCC Park below is the best spot for the classic tower photograph.</em></p>
                            </div>
                            HTML,
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 700.00],
                            ['age_group_id' => 2, 'price' => 350.00],
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
                'start_date' => '2026-05-05',
                'end_date' => '2028-05-05',
                'closing_type' => null,
                'closing_days' => [],
                'countries' => [165],
                'cities' => [17],
                'categories' => [1],
                'images' => [
                    'https://i.pinimg.com/736x/45/f7/88/45f7883ba243fa7ce88f0f80fcfe6cbc.jpg',
                    'https://i.pinimg.com/736x/53/e7/55/53e755e01ec12bdd3f69b5ee3a8dd024.jpg',
                    'https://i.pinimg.com/736x/f1/87/1f/f1871f264dcdffa74ad3f124b585d910.jpg',
                    'https://i.pinimg.com/736x/fc/0b/5a/fc0b5a71e517f4135d7c28fd579f1ba0.jpg',
                    'https://i.pinimg.com/736x/b2/1e/3b/b21e3bd9ad52099f73ed6cacee461ef0.jpg',
                    'https://i.pinimg.com/736x/5e/43/78/5e437851da52a508dbcb89370675b532.jpg',
                    'https://i.pinimg.com/736x/bf/8e/79/bf8e795a9dd401b75f76f26565657e51.jpg',
                    'https://i.pinimg.com/736x/92/1b/f3/921bf3d4d226d33225c0aee128d36405.jpg',
                    'https://i.pinimg.com/736x/95/ad/03/95ad03abbdba1026369294d85582964f.jpg',
                    'https://i.pinimg.com/736x/62/d7/ea/62d7ea76a95b3daf1b39052f77bc1fa3.jpg',
                ],
                'packages' => [
                    [
                        'name' => 'Guided Walking Tour',
                        'description' => <<<'HTML'
                            <div class="space-y-4">
                                <p>Walk through 240 years of Thai royal history in a single morning. This <strong>guided walking tour</strong> covers the Grand Palace complex and the Temple of the Emerald Buddha, then continues on foot to neighbouring Wat Pho, home to the 46-metre Reclining Buddha and the country's oldest massage school.</p>
                                <img src="https://i.pinimg.com/736x/45/f7/88/45f7883ba243fa7ce88f0f80fcfe6cbc.jpg" alt="Golden spires of the Grand Palace in Bangkok" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">What is included</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Licensed English-speaking guide for 3–4 hours</li>
                                    <li>Entrance fees to the Grand Palace, Wat Phra Kaew and Wat Pho</li>
                                    <li>Bottled water and a cold towel at each stop</li>
                                    <li>Small group of no more than 12 guests</li>
                                </ul>
                                <h4 class="text-base font-semibold">Your route</h4>
                                <ol class="list-decimal pl-5 space-y-1">
                                    <li>Meet at the palace gate and pass through the outer courtyards</li>
                                    <li>Wat Phra Kaew and the Emerald Buddha, Thailand's most sacred image</li>
                                    <li>The Chakri Maha Prasat throne hall and the royal reception halls</li>
                                    <li>A short walk south to Wat Pho and the Reclining Buddha</li>
                                    <li>The massage school courtyard and the 91 chedis before finishing</li>
                                </ol>
                                <img src="https://i.pinimg.com/736x/f1/87/1f/f1871f264dcdffa74ad3f124b585d910.jpg" alt="Reclining Buddha at Wat Pho" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">Good to know</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Dress code is strictly enforced: shoulders and knees covered, no see-through fabric</li>
                                    <li>Shoes must be removed before entering the temple buildings</li>
                                    <li>Start early — by 11:00 the courtyards are both crowded and very hot</li>
                                    <li>Ignore anyone outside the gates claiming the palace is closed; it is a well-known scam</li>
                                </ul>
                                <p><em>A traditional Thai massage at the Wat Pho school afterwards is the ideal way to finish the morning.</em></p>
                            </div>
                            HTML,
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 1600.00],
                            ['age_group_id' => 2, 'price' => 900.00],
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
                'start_date' => '2026-05-05',
                'end_date' => '2028-05-05',
                'closing_type' => null,
                'closing_days' => [],
                'countries' => [165],
                'cities' => [17],
                'categories' => [1],
                'images' => [
                    'https://i.pinimg.com/736x/fb/30/79/fb3079c52f46f7e4fa2b40a950ac8bf4.jpg',
                    'https://i.pinimg.com/736x/cb/24/0d/cb240d6910c6b5cd17c8958c08a9d66d.jpg',
                    'https://i.pinimg.com/736x/00/bb/2a/00bb2a4ea6342d025b09f0ff3a447a50.jpg',
                    'https://i.pinimg.com/736x/bb/60/d3/bb60d3960f59081f4d7db36962efff4b.jpg',
                    'https://i.pinimg.com/736x/13/92/27/139227abd3a5c93ee86ad777362d4928.jpg',
                    'https://i.pinimg.com/736x/e3/4f/87/e34f87ff2c640f880c1e7d0277c3a1fb.jpg',
                    'https://i.pinimg.com/736x/07/aa/6b/07aa6b65aa824e6d9794a98486237c5a.jpg',
                    'https://i.pinimg.com/736x/be/1b/cf/be1bcf8414b2d816cc068057aa5c1be3.jpg',
                    'https://i.pinimg.com/736x/36/b3/38/36b3387f10872f3ef42eb7e1ab8f1cf2.jpg',
                    'https://i.pinimg.com/736x/e3/2d/77/e32d7723d01a74c5dff51e6eb1886d9d.jpg',
                ],
                'packages' => [
                    [
                        'name' => 'Dinner Cruise Ticket',
                        'description' => <<<'HTML'
                            <div class="space-y-4">
                                <p>See Bangkok the way it was first built to be seen — from the water. This <strong>two-hour dinner cruise</strong> glides down the Chao Phraya after dark, past the floodlit spires of Wat Arun, the Grand Palace and the Rama VIII Bridge, with an unlimited Thai and international buffet and live music on deck.</p>
                                <img src="https://i.pinimg.com/736x/fb/30/79/fb3079c52f46f7e4fa2b40a950ac8bf4.jpg" alt="Illuminated dinner cruise boat on the Chao Phraya" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">What is included</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Two-hour cruise aboard a luxury air-conditioned river boat</li>
                                    <li>Unlimited Thai and international buffet with a seafood station</li>
                                    <li>Reserved table on the open-air upper deck where available</li>
                                    <li>Live Thai music and an on-board host providing commentary</li>
                                    <li>One complimentary soft drink; a full bar is available on board</li>
                                </ul>
                                <h4 class="text-base font-semibold">What you will pass</h4>
                                <ol class="list-decimal pl-5 space-y-1">
                                    <li>Wat Arun, the Temple of Dawn, lit from the water</li>
                                    <li>The Grand Palace and Wat Phra Kaew rooftops</li>
                                    <li>Rama VIII cable-stayed bridge at the turning point</li>
                                    <li>Riverside hotels, the Memorial Bridge and Asiatique on the return leg</li>
                                </ol>
                                <img src="https://i.pinimg.com/736x/00/bb/2a/00bb2a4ea6342d025b09f0ff3a447a50.jpg" alt="Bangkok riverside temples at night" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">Good to know</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Check in at the pier 30 minutes before the 19:30 departure</li>
                                    <li>Smart casual dress is recommended — no beachwear or flip-flops</li>
                                    <li>Vegetarian, halal and gluten-free menus are available on request when booking</li>
                                    <li>Upper-deck tables are allocated on a first-come basis, so arrive early</li>
                                </ul>
                                <p><em>The best photographs come in the first 20 minutes, while there is still a little light in the sky behind Wat Arun.</em></p>
                            </div>
                            HTML,
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 2100.00],
                            ['age_group_id' => 2, 'price' => 1200.00],
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
                'start_date' => '2026-05-05',
                'end_date' => '2028-05-05',
                'closing_type' => null,
                'closing_days' => [],
                'countries' => [152],
                'cities' => [87],
                'categories' => [1],
                'images' => [
                    'https://i.pinimg.com/736x/77/c1/13/77c1139a4614a24e539039a580fa18ea.jpg',
                    'https://i.pinimg.com/736x/1f/9c/cd/1f9ccddad3897c67583b849aed317139.jpg',
                    'https://i.pinimg.com/736x/94/ad/66/94ad664792b8b3012468c8d878247b42.jpg',
                    'https://i.pinimg.com/736x/7e/f9/76/7ef976639cb0b7a1486b7b3ae33100ab.jpg',
                    'https://i.pinimg.com/736x/41/ea/63/41ea63bfc53b3e40b34a43ca2b1181c2.jpg',
                    'https://i.pinimg.com/736x/8a/b1/16/8ab1168c5368db073f82953845793c7b.jpg',
                    'https://i.pinimg.com/736x/b2/2b/b9/b22bb92fbfebe6666ecde7d3c960dfb5.jpg',
                    'https://i.pinimg.com/736x/b4/d9/54/b4d9545a05a4c1fcf2a333dd20ef5dab.jpg',
                    'https://i.pinimg.com/736x/ff/ad/06/ffad06896b12fb9cd8ff45fe2f44c49d.jpg',
                    'https://i.pinimg.com/736x/b3/3b/12/b33b12593cb6cb45b0b14fa8ca193f56.jpg',
                ],
                'packages' => [
                    [
                        'name' => 'Night Safari Admission',
                        'description' => <<<'HTML'
                            <div class="space-y-4">
                                <p>The world's first nocturnal zoo opens when everything else closes. <strong>Night Safari admission</strong> gives you the tram loop through seven geographic zones plus four walking trails, where more than 2,500 animals from over 130 species are active in carefully lit, moat-separated habitats designed to mimic moonlight.</p>
                                <img src="https://i.pinimg.com/736x/77/c1/13/77c1139a4614a24e539039a580fa18ea.jpg" alt="Night Safari tram passing through the park" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">What is included</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Full admission to the Night Safari park</li>
                                    <li>Guided tram safari through all seven geographic zones</li>
                                    <li>Access to the Fishing Cat, Leopard, Wallaby and East Lodge walking trails</li>
                                    <li>Entry to the Creatures of the Night presentation and the Thumbuakar fire show</li>
                                </ul>
                                <h4 class="text-base font-semibold">How to plan your evening</h4>
                                <ol class="list-decimal pl-5 space-y-1">
                                    <li>Arrive by 19:00 and catch the Thumbuakar tribal fire performance at the entrance</li>
                                    <li>Take the tram loop first while your night vision is fresh</li>
                                    <li>Walk the Fishing Cat Trail for the closest views of the smaller nocturnal species</li>
                                    <li>Finish with the Creatures of the Night show in the amphitheatre</li>
                                </ol>
                                <img src="https://i.pinimg.com/736x/94/ad/66/94ad664792b8b3012468c8d878247b42.jpg" alt="Nocturnal animals at Singapore Night Safari" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">Good to know</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Flash photography is strictly prohibited — it distresses the animals</li>
                                    <li>Trams run every 8–10 minutes; the last departure is around 23:15</li>
                                    <li>Bring insect repellent and wear long sleeves for the walking trails</li>
                                    <li>Allow at least three hours to see the park properly</li>
                                </ul>
                                <p><em>The tram commentary is available in English and Mandarin — check the signage at the boarding lane before you queue.</em></p>
                            </div>
                            HTML,
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 1700.00],
                            ['age_group_id' => 2, 'price' => 1200.00],
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
                'start_date' => '2026-05-05',
                'end_date' => '2028-05-05',
                'closing_type' => null,
                'closing_days' => [],
                'countries' => [152],
                'cities' => [87],
                'categories' => [1],
                'images' => [
                    'https://i.pinimg.com/736x/f6/77/18/f677180d43a20efaf763bcf2f66461bf.jpg',
                    'https://i.pinimg.com/736x/98/43/05/984305572246ed603867c34d49b381a5.jpg',
                    'https://i.pinimg.com/736x/56/02/82/560282b64b05ed4e1f85bed71baa269b.jpg',
                    'https://i.pinimg.com/736x/42/2c/56/422c56b922e8b2730bc596a0fbe8a4a3.jpg',
                    'https://i.pinimg.com/736x/a0/c2/22/a0c222dfcb56cdf43b85ef64d142c9a3.jpg',
                    'https://i.pinimg.com/736x/df/77/9b/df779bc59113d334ec43d855e61f1ce5.jpg',
                    'https://i.pinimg.com/736x/26/1f/45/261f45cddcb017a3892f36b8c5e38d80.jpg',
                    'https://i.pinimg.com/736x/bd/fd/37/bdfd37f29b634c492fb0977ab5055120.jpg',
                    'https://i.pinimg.com/736x/7d/db/32/7ddb32178a4856590ddab7522d8e3bae.jpg',
                    'https://i.pinimg.com/736x/10/69/be/1069be3201504c4a7085fc00fc9ac48a.jpg',
                ],
                'packages' => [
                    [
                        'name' => 'Conservatories Combo',
                        'description' => <<<'HTML'
                            <div class="space-y-4">
                                <p>The <strong>Conservatories Combo</strong> covers both climate-controlled glasshouses at Gardens by the Bay: the Flower Dome, the largest columnless greenhouse in the world, and the Cloud Forest, built around a 35-metre indoor waterfall and a mist-wrapped mountain you climb from the top down.</p>
                                <img src="https://i.pinimg.com/736x/f6/77/18/f677180d43a20efaf763bcf2f66461bf.jpg" alt="Supertree Grove at Gardens by the Bay" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">What is included</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Admission to the Flower Dome, with nine distinct garden regions</li>
                                    <li>Admission to the Cloud Forest, including the Cloud Walk and Treetop Walk</li>
                                    <li>Access to the seasonal floral display, which changes several times a year</li>
                                    <li>Free entry to the outdoor gardens and Supertree Grove</li>
                                </ul>
                                <h4 class="text-base font-semibold">Suggested route</h4>
                                <ol class="list-decimal pl-5 space-y-1">
                                    <li>Start in the Cloud Forest — take the lift to level 6 and walk down through the mist</li>
                                    <li>Cross to the Flower Dome for the Mediterranean, Californian and baobab sections</li>
                                    <li>Walk out to the Supertree Grove in the late afternoon</li>
                                    <li>Stay for the Garden Rhapsody light and sound show after dark</li>
                                </ol>
                                <img src="https://i.pinimg.com/736x/56/02/82/560282b64b05ed4e1f85bed71baa269b.jpg" alt="Cloud Forest indoor waterfall" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">Good to know</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Both conservatories are kept at 23–25°C — bring a light layer</li>
                                    <li>Garden Rhapsody runs free at 19:45 and 20:45 every evening</li>
                                    <li>Allow 2–3 hours for both domes at a comfortable pace</li>
                                    <li>The OCBC Skyway between the Supertrees is ticketed separately</li>
                                </ul>
                                <p><em>The mist is released in the Cloud Forest every few minutes — wait for it before taking your photographs.</em></p>
                            </div>
                            HTML,
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 1000.00],
                            ['age_group_id' => 2, 'price' => 500.00],
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
                'start_date' => '2026-05-05',
                'end_date' => '2028-05-05',
                'closing_type' => null,
                'closing_days' => [],
                'countries' => [83],
                'cities' => [1],
                'categories' => [1],
                'images' => [
                    'https://i.pinimg.com/736x/b6/a3/63/b6a363fd36785ced5ee48dd8ff20ccaf.jpg',
                    'https://i.pinimg.com/736x/64/cd/c3/64cdc323ac84d320dab8264369d2b05f.jpg',
                    'https://i.pinimg.com/736x/4b/e8/59/4be85977f40b4f22bd9ae96df07f2851.jpg',
                    'https://i.pinimg.com/736x/bb/a4/0d/bba40dd024b24defe53d8493508753ac.jpg',
                    'https://i.pinimg.com/736x/0d/2d/f8/0d2df85a2f9b2f4d690a872ac6538d1b.jpg',
                    'https://i.pinimg.com/736x/28/31/da/2831da0f8a4b18fde25867ef90e66207.jpg',
                    'https://i.pinimg.com/736x/f1/15/45/f115450cc347177ebd85c0bcf7ff0946.jpg',
                    'https://i.pinimg.com/736x/b9/51/ad/b951ad2f0e374c898a01eca0887b8f39.jpg',
                    'https://i.pinimg.com/736x/54/20/f4/5420f48caca7471d7433944e5ed8596a.jpg',
                    'https://i.pinimg.com/736x/e1/2d/70/e12d702d208795e9aab0b3226e8c08aa.jpg',
                ],
                'packages' => [
                    [
                        'name' => 'Evening Walking Tour',
                        'description' => <<<'HTML'
                            <div class="space-y-4">
                                <p>Gion after sunset is one of the few places in Japan where the old world is still visibly at work. On this <strong>two-hour evening walk</strong>, a local guide leads you along Hanamikoji and the Shirakawa canal, explaining what geiko and maiko actually do, how the teahouse system works, and what all those doorway lanterns mean.</p>
                                <img src="https://i.pinimg.com/736x/b6/a3/63/b6a363fd36785ced5ee48dd8ff20ccaf.jpg" alt="Lantern-lit street in Gion, Kyoto" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">What is included</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Two-hour guided walk with a knowledgeable local guide</li>
                                    <li>Small group of no more than 10 people</li>
                                    <li>Commentary on geisha history, training and etiquette</li>
                                    <li>Visit to Yasaka Shrine and the Shirakawa canal district</li>
                                </ul>
                                <h4 class="text-base font-semibold">Your route</h4>
                                <ol class="list-decimal pl-5 space-y-1">
                                    <li>Meet at Yasaka Shrine as the lanterns are lit</li>
                                    <li>Walk down Hanamikoji Street past the historic ochaya teahouses</li>
                                    <li>Cross to Shirakawa canal, the most photographed lane in Kyoto</li>
                                    <li>Finish in Pontocho alley, with restaurant recommendations from your guide</li>
                                </ol>
                                <img src="https://i.pinimg.com/736x/4b/e8/59/4be85977f40b4f22bd9ae96df07f2851.jpg" alt="Traditional wooden machiya houses in Kyoto" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">Good to know</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Never stop, touch or block a maiko on her way to an appointment — she is at work</li>
                                    <li>Photography is banned on the private lanes off Hanamikoji, and fines are enforced</li>
                                    <li>Sightings are never guaranteed; early evening between 17:30 and 18:30 gives the best chance</li>
                                    <li>The tour runs in light rain — bring an umbrella rather than rescheduling</li>
                                </ul>
                                <p><em>Wear comfortable shoes; the route covers around 2.5 km of stone-paved streets.</em></p>
                            </div>
                            HTML,
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 1900.00],
                            ['age_group_id' => 2, 'price' => 1200.00],
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
                'start_date' => '2026-05-05',
                'end_date' => '2028-05-05',
                'closing_type' => null,
                'closing_days' => [],
                'countries' => [200],
                'cities' => [221],
                'categories' => [1],
                'images' => [
                    'https://i.pinimg.com/736x/29/8a/f0/298af03e61c099e882319e35e9e24362.jpg',
                    'https://i.pinimg.com/736x/11/d2/41/11d241fb88f601682197f6531e284397.jpg',
                    'https://i.pinimg.com/736x/8d/76/bd/8d76bd72770f76a4df5944161b3b8256.jpg',
                    'https://i.pinimg.com/736x/63/a8/06/63a80603eb18f74dad76ff878c5d9d2a.jpg',
                    'https://i.pinimg.com/736x/37/47/15/374715bf401583ac00556d4c3bd40a07.jpg',
                    'https://i.pinimg.com/736x/25/1d/56/251d56c222c6024cb517fc0313c4c6b6.jpg',
                    'https://i.pinimg.com/736x/65/65/b4/6565b45e9f3f356310a38010ab4d1b8f.jpg',
                    'https://i.pinimg.com/736x/1c/7e/85/1c7e85c60d8787539b6071c0d7594a71.jpg',
                    'https://i.pinimg.com/736x/6b/e4/6c/6be46c0f8b13fb8e0dc9b9d7d07cf322.jpg',
                    'https://i.pinimg.com/736x/1d/01/81/1d01817aabf5c404cc273381dceb1435.jpg',
                ],
                'packages' => [
                    [
                        'name' => 'General Admission',
                        'description' => <<<'HTML'
                            <div class="space-y-4">
                                <p>The <strong>Dubai Frame</strong> is exactly what its name suggests: a 150-metre golden picture frame standing in Zabeel Park, deliberately positioned so that old Dubai fills one side and the modern skyline fills the other. The glass-floored sky bridge across the top connects the two views — and the two eras.</p>
                                <img src="https://i.pinimg.com/736x/29/8a/f0/298af03e61c099e882319e35e9e24362.jpg" alt="The Dubai Frame in Zabeel Park" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">What is included</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>General admission ticket to the Dubai Frame</li>
                                    <li>Lift access to the level 48 sky bridge</li>
                                    <li>Walk across the 25-metre glass-floored panel</li>
                                    <li>Entry to the ground-floor Past Dubai gallery and the Future Dubai projection room</li>
                                </ul>
                                <h4 class="text-base font-semibold">How the visit works</h4>
                                <ol class="list-decimal pl-5 space-y-1">
                                    <li>Walk through the Past Dubai museum on the ground floor</li>
                                    <li>Take the 75-second lift to the top of the frame</li>
                                    <li>Look north over Deira and old Dubai, then south to Sheikh Zayed Road</li>
                                    <li>Descend into the Future Dubai immersive gallery on your way out</li>
                                </ol>
                                <img src="https://i.pinimg.com/736x/8d/76/bd/8d76bd72770f76a4df5944161b3b8256.jpg" alt="View through the Dubai Frame sky bridge" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">Good to know</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Allow 1–2 hours for the whole visit including the galleries</li>
                                    <li>Excellent value compared with the city's other observation decks, and very family-friendly</li>
                                    <li>Zabeel Park charges a small separate entrance fee at the gate</li>
                                    <li>Late afternoon gives the clearest view in both directions</li>
                                </ul>
                                <p><em>The glass floor turns opaque and then clear as you step onto it — worth waiting for the effect before crossing.</em></p>
                            </div>
                            HTML,
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 550.00],
                            ['age_group_id' => 2, 'price' => 280.00],
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
                'start_date' => '2026-05-05',
                'end_date' => '2028-05-05',
                'closing_type' => ClosingTypeEnum::CLOSING_DAYS->value,
                'closing_days' => ['Tuesday'],
                'countries' => [101],
                'cities' => [48],
                'categories' => [1],
                'images' => [
                    'https://i.pinimg.com/736x/30/bb/3b/30bb3b2888ec48ed14b984f8c2cfd586.jpg',
                    'https://i.pinimg.com/736x/2c/e0/90/2ce090a1b74ced4744ce783bfd01b9b7.jpg',
                    'https://i.pinimg.com/736x/85/ad/bc/85adbc0527bbda7d7c8b97fe04513394.jpg',
                    'https://i.pinimg.com/736x/f9/6d/bc/f96dbc41423cd3ee53aea4e4e56f1d5b.jpg',
                    'https://i.pinimg.com/736x/57/ed/a6/57eda615542ff4e52778fc6a2f891f99.jpg',
                    'https://i.pinimg.com/736x/2d/06/c1/2d06c17284b30990b13a571811edf536.jpg',
                    'https://i.pinimg.com/736x/0e/95/21/0e95218e09c5beaa6fb1aab63af952bf.jpg',
                    'https://i.pinimg.com/736x/90/4e/30/904e3046d07b5dbca86c1ecfac3aaa1f.jpg',
                    'https://i.pinimg.com/736x/78/1d/7b/781d7b9fc6fcd892c876940c9a8d35c8.jpg',
                    'https://i.pinimg.com/736x/43/5b/bf/435bbff43301838c8f6be86723bb3343.jpg',
                ],
                'packages' => [
                    [
                        'name' => 'Cable Car + Sky Bridge',
                        'description' => <<<'HTML'
                            <div class="space-y-4">
                                <p>Ride one of the steepest cable car systems in the world to the summit of Mount Mat Cincang, then walk out onto the curved <strong>Langkawi Sky Bridge</strong> — a 125-metre pedestrian deck suspended on a single pylon, hanging 700 metres above the rainforest canopy with the Andaman Sea beyond.</p>
                                <img src="https://i.pinimg.com/736x/30/bb/3b/30bb3b2888ec48ed14b984f8c2cfd586.jpg" alt="Langkawi Sky Bridge above the rainforest" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">What is included</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Return cable car ride with stops at the middle and top stations</li>
                                    <li>Sky Bridge access and the SkyGlide inclined lift</li>
                                    <li>Time at both viewing platforms and the Seven Wells waterfall viewpoint</li>
                                    <li>Access to the Oriental Village complex at the base station</li>
                                </ul>
                                <h4 class="text-base font-semibold">Your ascent</h4>
                                <ol class="list-decimal pl-5 space-y-1">
                                    <li>Board at the Oriental Village base station in Teluk Burau</li>
                                    <li>Stop at the middle station for the Seven Wells waterfall viewpoint</li>
                                    <li>Continue to the top station at 708 metres for panoramic views</li>
                                    <li>Take the SkyGlide down to the Sky Bridge and walk the full curve</li>
                                </ol>
                                <img src="https://i.pinimg.com/736x/2c/e0/90/2ce090a1b74ced4744ce783bfd01b9b7.jpg" alt="Cable car gondola over Langkawi rainforest" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">Good to know</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>The cable car and bridge close during thunderstorms and high winds — mornings are safest</li>
                                    <li>Closed on Tuesdays for scheduled maintenance</li>
                                    <li>Wear shoes with grip; the bridge deck can be slick after rain</li>
                                    <li>Not recommended for guests with a severe fear of heights</li>
                                </ul>
                                <p><em>On a clear day you can see across to Thailand's Tarutao island chain from the top station.</em></p>
                            </div>
                            HTML,
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 900.00],
                            ['age_group_id' => 2, 'price' => 650.00],
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
                'start_date' => '2026-05-05',
                'end_date' => '2028-05-05',
                'closing_type' => null,
                'closing_days' => [],
                'countries' => [78],
                'cities' => [87],
                'categories' => [1],
                'images' => [
                    'https://i.pinimg.com/736x/a5/97/53/a5975324b0ae981e5354863566436e62.jpg',
                    'https://i.pinimg.com/736x/97/b6/22/97b6225c22cbe34d94084ca6b7c0c00d.jpg',
                    'https://i.pinimg.com/736x/51/7a/2e/517a2e0d73728aab72901ca1fddab89b.jpg',
                    'https://i.pinimg.com/736x/b2/40/c1/b240c17eadf433025a4dc6d88f72b646.jpg',
                    'https://i.pinimg.com/736x/6a/e0/b6/6ae0b60436a1d494069a8ffb4dbe8116.jpg',
                    'https://i.pinimg.com/736x/5e/21/94/5e2194e8759ccb843694cede557fc008.jpg',
                    'https://i.pinimg.com/736x/e4/de/dd/e4dedd90cf8b69ab9b51e806cdd27b8.jpg',
                    'https://i.pinimg.com/736x/e3/96/ee/e396ee82b94a57e3a0db5b87cb2530cb.jpg',
                    'https://i.pinimg.com/736x/fd/82/ce/fd82ce6b601bfec84968ab6e491187ce.jpg',
                    'https://i.pinimg.com/736x/dc/84/93/dc84930568de8f90ed05037c5be32ca6.jpg',
                ],
                'packages' => [
                    [
                        'name' => 'Sunset Tour with Transfer',
                        'description' => <<<'HTML'
                            <div class="space-y-4">
                                <p><strong>Pura Tanah Lot</strong> sits on a rock formation just offshore, cut off by the tide twice a day and framed by the Indian Ocean behind it. This guided tour times your arrival for the hour before sunset, when the silhouette of the temple against the sky is at its most photogenic.</p>
                                <img src="https://i.pinimg.com/736x/a5/97/53/a5975324b0ae981e5354863566436e62.jpg" alt="Tanah Lot temple at sunset" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">What is included</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Private air-conditioned transfer from your hotel and back</li>
                                    <li>English-speaking driver-guide</li>
                                    <li>Temple entrance fee and parking</li>
                                    <li>Bottled water and a sarong to borrow</li>
                                </ul>
                                <h4 class="text-base font-semibold">Your afternoon</h4>
                                <ol class="list-decimal pl-5 space-y-1">
                                    <li>15:00 — pick-up from Seminyak, Kuta, Canggu or Ubud</li>
                                    <li>16:30 — arrive at Tanah Lot and walk the clifftop path for the classic viewpoints</li>
                                    <li>17:00 — visit the holy snake shrine and, at low tide, the blessing spring at the base of the rock</li>
                                    <li>18:15 — sunset from the upper terrace, then browse the craft market on the way out</li>
                                    <li>19:30 — return to your hotel</li>
                                </ol>
                                <img src="https://i.pinimg.com/736x/51/7a/2e/517a2e0d73728aab72901ca1fddab89b.jpg" alt="Waves breaking below Tanah Lot" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">Good to know</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Only Hindu worshippers may enter the temple itself; visitors view it from the shore</li>
                                    <li>The base of the rock is reachable only at low tide — your guide will check the tide table</li>
                                    <li>Arrive at least an hour before sunset to secure a good spot</li>
                                    <li>The path down to the shore is uneven and slippery when wet</li>
                                </ul>
                                <p><em>Bring a little cash for the market stalls and for the optional blessing at the holy spring.</em></p>
                            </div>
                            HTML,
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 1200.00],
                            ['age_group_id' => 2, 'price' => 700.00],
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
                'start_date' => '2026-05-05',
                'end_date' => '2028-05-05',
                'closing_type' => null,
                'closing_days' => [],
                'countries' => [165],
                'cities' => [17],
                'categories' => [1],
                'images' => [
                    'https://i.pinimg.com/736x/29/b1/ff/29b1ff4a4b07d0f30f266855f431ba6a.jpg',
                    'https://i.pinimg.com/736x/70/ff/eb/70ffebc3d8fafe1317182ebfa448e113.jpg',
                    'https://i.pinimg.com/736x/65/79/99/657999ad91018b593c9f8092c116e29d.jpg',
                    'https://i.pinimg.com/736x/09/20/26/092026660046762e025cf719606663e0.jpg',
                    'https://i.pinimg.com/736x/85/46/bc/8546bcb63c0a5e8ec1736dbbcd902226.jpg',
                    'https://i.pinimg.com/736x/85/ba/a1/85baa149fd71a55c0986a2c684f9b2f3.jpg',
                    'https://i.pinimg.com/736x/2c/37/d6/2c37d6d4a932793ffdff6a158004e608.jpg',
                    'https://i.pinimg.com/736x/79/01/dd/7901dd025e9e3649082e9ce4f6f11c86.jpg',
                    'https://i.pinimg.com/736x/1a/05/04/1a05043ba270637e3aaddca04a2656f2.jpg',
                    'https://i.pinimg.com/736x/1b/51/61/1b5161aeee4860aa994a12eeb3cf2616.jpg',
                ],
                'packages' => [
                    [
                        'name' => 'Floating Market Half Day Tour',
                        'description' => <<<'HTML'
                            <div class="space-y-4">
                                <p>Head out of Bangkok before dawn to reach <strong>Damnoen Saduak floating market</strong> while it is still working rather than performing. A paddled longtail boat carries you through the narrow canals, past vendors selling noodles, grilled prawns, mango sticky rice and tropical fruit directly from their sampans.</p>
                                <img src="https://i.pinimg.com/736x/29/b1/ff/29b1ff4a4b07d0f30f266855f431ba6a.jpg" alt="Vendor boats at Damnoen Saduak floating market" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">What is included</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Hotel pick-up and drop-off in central Bangkok</li>
                                    <li>Air-conditioned minivan for the 100 km journey each way</li>
                                    <li>English-speaking guide throughout</li>
                                    <li>30-minute paddle boat ride through the market canals</li>
                                    <li>Bottled water and a stop at a coconut sugar farm</li>
                                </ul>
                                <h4 class="text-base font-semibold">Your morning</h4>
                                <ol class="list-decimal pl-5 space-y-1">
                                    <li>06:00 — early pick-up to beat both the traffic and the tour buses</li>
                                    <li>07:30 — coconut sugar plantation stop with tastings</li>
                                    <li>08:30 — board your paddle boat and enter the market canals</li>
                                    <li>10:00 — free time to walk the canal-side stalls and eat</li>
                                    <li>12:30 — return to Bangkok by around 13:00</li>
                                </ol>
                                <img src="https://i.pinimg.com/736x/65/79/99/657999ad91018b593c9f8092c116e29d.jpg" alt="Longtail boat in a Thai canal market" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">Good to know</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>The market is busiest and most authentic before 09:00 — later it is largely souvenir stalls</li>
                                    <li>Bargaining is expected and part of the experience; start at around half the asking price</li>
                                    <li>Bring small notes — most vendors cannot change large bills</li>
                                    <li>Motorised longtail add-ons are offered at the pier and are not included</li>
                                </ul>
                                <p><em>Sit at the front of the paddle boat for unobstructed photographs down the canal.</em></p>
                            </div>
                            HTML,
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 1400.00],
                            ['age_group_id' => 2, 'price' => 900.00],
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
                'start_date' => '2026-05-05',
                'end_date' => '2028-05-05',
                'closing_type' => null,
                'closing_days' => [],
                'countries' => [152],
                'cities' => [87],
                'categories' => [1],
                'images' => [
                    'https://i.pinimg.com/736x/f9/a2/7f/f9a27f2a857e86d613aa1345ae13859a.jpg',
                    'https://i.pinimg.com/736x/c0/36/51/c036511c8006967819f84f1b83ed8c66.jpg',
                    'https://i.pinimg.com/736x/be/47/6a/be476ab78aa3322d0e5bc3a7a8ce3a25.jpg',
                    'https://i.pinimg.com/736x/26/fe/ec/26feec4bb699ea7d3b98a80f6fd3521.jpg',
                    'https://i.pinimg.com/736x/59/17/04/59170401053592e2f35526637cfad2b4.jpg',
                    'https://i.pinimg.com/736x/aa/7b/cc/aa7bcc36e77f916e62a96dfc525b1fcc.jpg',
                    'https://i.pinimg.com/736x/a6/c6/e4/a6c6e40406663758c64de811a3a51080.jpg',
                    'https://i.pinimg.com/736x/9f/fc/65/9ffc654d6a85d89e9b25d8a46b49462c.jpg',
                    'https://i.pinimg.com/736x/6c/52/c3/6c52c3a814cb9a701e9fc9c98970fa70.jpg',
                    'https://i.pinimg.com/736x/6f/ce/a0/6fcea09b94c16dad39e74a7d1511b774.jpg',
                ],
                'packages' => [
                    [
                        'name' => 'All-Day Island Pass',
                        'description' => <<<'HTML'
                            <div class="space-y-4">
                                <p>Sentosa packs beaches, forts, cable cars and adventure parks onto one small island, and the <strong>All-Day Island Pass</strong> is the simplest way to cover it. Unlimited hop-on hop-off bus and beach tram rides let you set your own route, stopping wherever looks interesting and moving on when you are ready.</p>
                                <img src="https://i.pinimg.com/736x/f9/a2/7f/f9a27f2a857e86d613aa1345ae13859a.jpg" alt="Beach on Sentosa Island, Singapore" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">What is included</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Unlimited rides on all hop-on hop-off bus lines for one full day</li>
                                    <li>Unlimited beach tram travel between Siloso, Palawan and Tanjong beaches</li>
                                    <li>Island entry and access to all public beaches</li>
                                    <li>Route map and audio commentary on the bus lines</li>
                                </ul>
                                <h4 class="text-base font-semibold">Stops worth making</h4>
                                <ol class="list-decimal pl-5 space-y-1">
                                    <li><strong>Palawan Beach</strong> — cross the suspension bridge to the southernmost point of continental Asia</li>
                                    <li><strong>Siloso Beach</strong> — the liveliest stretch, with beach bars and water sports</li>
                                    <li><strong>Fort Siloso</strong> — a preserved WWII coastal battery with a free skywalk</li>
                                    <li><strong>Imbiah Lookout</strong> — the cable car station and the island's best viewpoint</li>
                                </ol>
                                <img src="https://i.pinimg.com/736x/be/47/6a/be476ab78aa3322d0e5bc3a7a8ce3a25.jpg" alt="Sentosa Island cable car and coastline" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">Good to know</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Bring swimwear and a towel — the beaches are free to use with your pass</li>
                                    <li>Buses run roughly every 15 minutes from 10:00 to 22:00</li>
                                    <li>Attraction admissions such as Adventure Cove are ticketed separately</li>
                                    <li>The cable car is a separate ticket but stops on the same route</li>
                                </ul>
                                <p><em>Start at the far end of the island and work back towards the beaches for the afternoon — the crowds move the other way.</em></p>
                            </div>
                            HTML,
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 750.00],
                            ['age_group_id' => 2, 'price' => 500.00],
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
                'start_date' => '2026-05-05',
                'end_date' => '2028-05-05',
                'closing_type' => null,
                'closing_days' => [],
                'countries' => [165],
                'cities' => [7024],
                'categories' => [1],
                'images' => [
                    'https://i.pinimg.com/736x/40/cd/42/40cd42acdbf836a853a82f62d538a478.jpg',
                    'https://i.pinimg.com/736x/3d/96/c2/3d96c213a74d5a008986d0e1aa123e29.jpg',
                    'https://i.pinimg.com/736x/d0/13/e7/d013e7ef7b87c11ef07bc99618905ea7.jpg',
                    'https://i.pinimg.com/736x/76/dc/be/76dcbe5c1ecc25c82dbbec00dc0f2a34.jpg',
                    'https://i.pinimg.com/736x/5b/a7/4d/5ba74d095370341b567ef47866e505c1.jpg',
                    'https://i.pinimg.com/736x/a5/46/be/a546be45da18d11586ac0566f2f79901.jpg',
                    'https://i.pinimg.com/736x/07/e4/76/07e47625ef1d5264dd3f4ae1cbc860ac.jpg',
                    'https://i.pinimg.com/736x/18/22/45/182245584f6f3aeb1f189d7124d764d9.jpg',
                    'https://i.pinimg.com/736x/74/29/35/742935d7f8337358fb24cea6e5ee2f31.jpg',
                    'https://i.pinimg.com/736x/39/ac/fc/39acfc4b57ef8ec03a7c12f73b88277e.jpg',
                ],
                'packages' => [
                    [
                        'name' => 'Full Day Snorkelling Trip',
                        'description' => <<<'HTML'
                            <div class="space-y-4">
                                <p><strong>Coral Island</strong> (Koh Hae) is only 15 minutes by speedboat from Phuket, but the water clarity is a different world. This full-day trip gives you two beaches, a healthy fringing reef straight off the sand, and enough time to actually relax rather than being marched between stops.</p>
                                <img src="https://i.pinimg.com/736x/40/cd/42/40cd42acdbf836a853a82f62d538a478.jpg" alt="Clear turquoise water at Coral Island, Phuket" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">What is included</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Hotel transfers from Patong, Kata, Karon and Phuket town</li>
                                    <li>Return speedboat transfer from Chalong pier</li>
                                    <li>Snorkelling mask, snorkel, fins and life jacket</li>
                                    <li>Thai buffet lunch on the beach with drinking water and seasonal fruit</li>
                                    <li>Beach chair, umbrella and an English-speaking guide</li>
                                </ul>
                                <h4 class="text-base font-semibold">Your day</h4>
                                <ol class="list-decimal pl-5 space-y-1">
                                    <li>08:30 — hotel pick-up and transfer to Chalong pier</li>
                                    <li>09:30 — 15-minute speedboat crossing to Banana Beach</li>
                                    <li>10:00 — first snorkelling session over the reef shelf</li>
                                    <li>12:00 — buffet lunch on Long Beach</li>
                                    <li>13:30 — free time for swimming, optional parasailing or banana boat</li>
                                    <li>15:30 — return to Phuket by around 16:30</li>
                                </ol>
                                <img src="https://i.pinimg.com/736x/d0/13/e7/d013e7ef7b87c11ef07bc99618905ea7.jpg" alt="Snorkelling over a coral reef" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">Good to know</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Non-swimmers are welcome — life jackets are provided and the reef starts in shallow water</li>
                                    <li>Use reef-safe sunscreen; oil-based products damage the coral</li>
                                    <li>Water sports at the beach are operated by third parties and paid separately</li>
                                    <li>The best visibility is between November and April</li>
                                </ul>
                                <p><em>Banana Beach on the north side is quieter than Long Beach if you want the reef largely to yourself.</em></p>
                            </div>
                            HTML,
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 1900.00],
                            ['age_group_id' => 2, 'price' => 1200.00],
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
                'start_date' => '2026-05-05',
                'end_date' => '2028-05-05',
                'closing_type' => null,
                'closing_days' => [],
                'countries' => [165],
                'cities' => [10484],
                'categories' => [1],
                'images' => [
                    'https://i.pinimg.com/736x/36/86/0b/36860b7072ad60a3914b58326bac87e7.jpg',
                    'https://i.pinimg.com/736x/d6/39/60/d63960467bb77cf522990c921088d390.jpg',
                    'https://i.pinimg.com/736x/13/f6/e3/13f6e34e1a8ce1c420988ba4c3a90aae.jpg',
                    'https://i.pinimg.com/736x/a9/9e/fc/a99efc0c5e190a23cb34f3530349952f.jpg',
                    'https://i.pinimg.com/736x/43/8a/2e/438a2e134faa28b43751bd8d1da7627e.jpg',
                    'https://i.pinimg.com/736x/80/3d/3a/803d3a0eea2d55a7cabc737924ee9334.jpg',
                    'https://i.pinimg.com/736x/e2/21/d8/e221d85c3342a3f2883dc1fc567832a3.jpg',
                    'https://i.pinimg.com/736x/cd/13/38/cd1338e66a30729acd247fa1e30b40fb.jpg',
                    'https://i.pinimg.com/736x/31/16/48/3116481dd87f25d31a8feef3e1a8192d.jpg',
                    'https://i.pinimg.com/736x/c5/ee/d9/c5eed937871e0f9f3e544e9c6dd9f000.jpg',
                ],
                'packages' => [
                    [
                        'name' => 'Full Day Ayutthaya Tour',
                        'description' => <<<'HTML'
                            <div class="space-y-4">
                                <p>For four centuries <strong>Ayutthaya</strong> was one of the largest and wealthiest cities on earth, until it was sacked in 1767. What remains is a UNESCO World Heritage Site of brick prangs, headless Buddhas and the famous stone head held in the roots of a banyan tree — all within an hour of Bangkok.</p>
                                <img src="https://i.pinimg.com/736x/36/86/0b/36860b7072ad60a3914b58326bac87e7.jpg" alt="Ancient temple ruins at Ayutthaya" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">What is included</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Round-trip air-conditioned transport from Bangkok</li>
                                    <li>Licensed English-speaking guide for the full day</li>
                                    <li>All temple entrance fees within the Historical Park</li>
                                    <li>Thai lunch at a riverside restaurant</li>
                                    <li>Bottled water throughout the day</li>
                                </ul>
                                <h4 class="text-base font-semibold">Temples you will visit</h4>
                                <ol class="list-decimal pl-5 space-y-1">
                                    <li><strong>Wat Mahathat</strong> — the Buddha head entwined in banyan roots</li>
                                    <li><strong>Wat Phra Si Sanphet</strong> — three royal chedis, the model for Bangkok's Grand Palace</li>
                                    <li><strong>Wat Chaiwatthanaram</strong> — the riverside Khmer-style complex, best in late light</li>
                                    <li><strong>Wat Lokayasutharam</strong> — a 42-metre reclining Buddha in the open air</li>
                                </ol>
                                <img src="https://i.pinimg.com/736x/13/f6/e3/13f6e34e1a8ce1c420988ba4c3a90aae.jpg" alt="Row of Buddha statues at Ayutthaya" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">Good to know</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Dress modestly — shoulders and knees covered at all temple sites</li>
                                    <li>There is very little shade; bring a hat, sunscreen and plenty of water</li>
                                    <li>Never pose with your head higher than a Buddha image, and never sit on the ruins</li>
                                    <li>Midday is punishing in April and May — the tour front-loads the walking</li>
                                </ul>
                                <p><em>Wat Chaiwatthanaram is scheduled last on purpose: the late afternoon light on the western prangs is the best photograph of the day.</em></p>
                            </div>
                            HTML,
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 1750.00],
                            ['age_group_id' => 2, 'price' => 1050.00],
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
                'start_date' => '2026-05-05',
                'end_date' => '2028-05-05',
                'closing_type' => null,
                'closing_days' => [],
                'countries' => [165],
                'cities' => [7024],
                'categories' => [1],
                'images' => [
                    'https://i.pinimg.com/736x/dc/ee/a8/dceea8998d063da7b99e88889277b6c4.jpg',
                    'https://i.pinimg.com/736x/5a/de/00/5ade0058c3683d94d225ee8b8f136726.jpg',
                    'https://i.pinimg.com/736x/18/d3/0b/18d30b9ea25cafe7043ce3b548f384fb.jpg',
                    'https://i.pinimg.com/736x/4b/71/81/4b7181f06652a6902ae7a1cfeba56df0.jpg',
                    'https://i.pinimg.com/736x/eb/61/38/eb6138b410e4376a234e5452e9388b03.jpg',
                    'https://i.pinimg.com/736x/3c/7b/2a/3c7b2adb898c0302a9150a83d009224e.jpg',
                    'https://i.pinimg.com/736x/f2/78/f0/f278f0d3ea06fc7f6d24d83623dc39b6.jpg',
                    'https://i.pinimg.com/736x/b0/2e/1c/b02e1ca09e58c91eac3641119564168b.jpg',
                    'https://i.pinimg.com/736x/89/ca/c2/89cac234eb397f1bccf962337af3544e.jpg',
                    'https://i.pinimg.com/736x/c4/84/3e/c4843e5375da0b0c8183fb146d10b8fa.jpg',
                ],
                'packages' => [
                    [
                        'name' => '2-Day 1-Night Raft House Package',
                        'description' => <<<'HTML'
                            <div class="space-y-4">
                                <p>Escape into deep nature with a <strong>2-Day 1-Night Raft House Package</strong> on Cheow Lan Lake in Khao Sok National Park. Sleep floating on emerald lake waters surrounded by ancient limestone karst cliffs, wake up to morning mist rolling over wild rainforest, and enjoy kayaking directly from your private balcony.</p>
                                <img src="https://i.pinimg.com/736x/dc/ee/a8/dceea8998d063da7b99e88889277b6c4.jpg" alt="Floating raft house on Cheow Lan Lake" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">What to expect</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Overnight accommodation in a traditional floating bamboo or wooden raft bungalow</li>
                                    <li>Full-board delicious local Thai meals (Day 1 lunch & dinner, Day 2 breakfast & lunch)</li>
                                    <li>Scenic longtail boat safari across Cheow Lan Lake past the iconic Three Brothers rocks</li>
                                    <li>Guided jungle cave exploration and nature trekking with an experienced ranger</li>
                                    <li>Free use of kayaks to paddle directly from your raft room</li>
                                </ul>
                                <h4 class="text-base font-semibold">Highlights</h4>
                                <ol class="list-decimal pl-5 space-y-1">
                                    <li>Early morning boat safari watching for wild hornbills, gibbons, and spectacled langurs</li>
                                    <li>Night wildlife spotting safari by longtail boat under a canopy of stars</li>
                                    <li>Swimming in pristine, warm freshwater right outside your cabin door</li>
                                    <li>Unrivaled panoramic views of 700-meter vertical karst mountain peaks rising from turquoise waters</li>
                                </ol>
                                <img src="https://i.pinimg.com/736x/5a/de/00/5ade0058c3683d94d225ee8b8f136726.jpg" alt="Kayaking on Cheow Lan Lake Khao Sok" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">Good to know</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Raft houses operate off-grid; solar electricity is available only during evening hours (18:00–23:00)</li>
                                    <li>No cell phone signal or Wi-Fi on the lake — perfect for a true digital detox</li>
                                    <li>Bring waterproof dry bags, headlamps, insect repellent, and quick-dry footwear</li>
                                    <li>National park entrance fees (300 THB) are collected at the pier</li>
                                </ul>
                                <p><em>Set your alarm for 06:00 AM to catch the magical morning mist rising above the karst reflections.</em></p>
                            </div>
                            HTML,
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 4200.00],
                            ['age_group_id' => 2, 'price' => 3000.00],
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
                'start_date' => '2026-05-05',
                'end_date' => '2028-05-05',
                'closing_type' => null,
                'closing_days' => [],
                'countries' => [165],
                'cities' => [7024],
                'categories' => [1],
                'images' => [
                    'https://i.pinimg.com/736x/91/ac/33/91ac33f3490d699cafc32007586514e4.jpg',
                    'https://i.pinimg.com/736x/ee/c7/9d/eec79d5b63baea2b49485fab642555ce.jpg',
                    'https://i.pinimg.com/736x/1e/92/88/1e92884a6c97ee795ac10399d6951ab0.jpg',
                    'https://i.pinimg.com/736x/ad/cc/97/adcc972a7453e3045b8a19a1150aca43.jpg',
                    'https://i.pinimg.com/736x/10/c1/4e/10c14e346380875475787defc3ea6bfc.jpg',
                    'https://i.pinimg.com/736x/81/f3/b6/81f3b66d6fc757e2a462efe268cf0590.jpg',
                    'https://i.pinimg.com/736x/e7/f0/45/e7f045333be9d7acf251c5ce70abbfd3.jpg',
                    'https://i.pinimg.com/736x/d3/58/69/d35869fb3400a4c1e600cb7838870020.jpg',
                    'https://i.pinimg.com/736x/0b/a3/36/0ba33625a8c29c5bba101336161e800e.jpg',
                    'https://i.pinimg.com/736x/d8/8b/85/d88b85e5fbb19d0e084ce5063be7e9fa.jpg',
                ],
                'packages' => [
                    [
                        'name' => 'Full Day Boat Tour',
                        'description' => <<<'HTML'
                            <div class="space-y-4">
                                <p>Embark on a classic <strong>Full Day Boat Tour</strong> through the dramatic limestone labyrinth of Phang Nga Bay. Visit Koh Tapu (James Bond Island), famously showcased in <em>The Man with the Golden Gun</em>, explore mysterious sea caves, and enjoy a warm seafood buffet at the sea-stilted village of Koh Panyee.</p>
                                <img src="https://i.pinimg.com/736x/91/ac/33/91ac33f3490d699cafc32007586514e4.jpg" alt="James Bond Island Koh Tapu" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">What to expect</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Round-trip hotel transfers from major Phuket beach areas in air-conditioned minivans</li>
                                    <li>Scenic cruise through Phang Nga Bay National Park aboard a traditional longtail boat</li>
                                    <li>Freshly prepared buffet lunch served at Koh Panyee floating Muslim village</li>
                                    <li>Up-close photo stops at James Bond Island and Khao Phing Kan leaning rock cliffs</li>
                                    <li>Comprehensive national park entry fees and full passenger insurance</li>
                                </ul>
                                <h4 class="text-base font-semibold">Highlights</h4>
                                <ol class="list-decimal pl-5 space-y-1">
                                    <li>Posing in front of the iconic nail-shaped Koh Tapu karst towering over green sea water</li>
                                    <li>Walking through the narrow rock crevices of Khao Phing Kan</li>
                                    <li>Exploring Koh Panyee floating village built entirely on stilts over water, including its floating soccer pitch</li>
                                    <li>Cruising past ancient mangrove forests home to wild monitor lizards and sea eagles</li>
                                </ol>
                                <img src="https://i.pinimg.com/736x/ee/c7/9d/eec79d5b63baea2b49485fab642555ce.jpg" alt="Phang Nga Bay limestone karst cliffs" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">Good to know</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Wear easily removable slip-on shoes or water sandals as getting on and off boats involves shallow water</li>
                                    <li>Souvenir vendors on James Bond Island can be pushy; gentle haggling is accepted</li>
                                    <li>Please respect local customs when visiting Koh Panyee floating village by wearing covered shoulders</li>
                                </ul>
                                <p><em>Morning departures arrive before the major tour crowd waves for much cleaner photos of Koh Tapu.</em></p>
                            </div>
                            HTML,
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 2100.00],
                            ['age_group_id' => 2, 'price' => 1400.00],
                        ],
                    ],
                    [
                        'name' => 'Sea Canoe + James Bond Island',
                        'description' => <<<'HTML'
                            <div class="space-y-4">
                                <p>Upgrade your Phang Nga Bay adventure with the premium <strong>Sea Canoe + James Bond Island</strong> package. Guided by experienced local paddlers, glide inside hidden hongs (sea lagoons) and limestone caves at Panak and Hong Islands where standard motorized boats cannot enter.</p>
                                <img src="https://i.pinimg.com/736x/1e/92/88/1e92884a6c97ee795ac10399d6951ab0.jpg" alt="Sea canoeing in Phang Nga Bay sea caves" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">What to expect</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Guided inflatable sea canoe exploration of dark sea caves, stalactites, and hidden internal lagoons</li>
                                    <li>Full visit to iconic James Bond Island (Koh Tapu) and Khao Phing Kan</li>
                                    <li>Sumptuous international and Thai buffet lunch served on board the big escort cruiser</li>
                                    <li>Swimming, sunbathing, and self-paddling opportunities at Naka Island beach</li>
                                    <li>Safety equipment, life jackets, dry bags, and soft drinks throughout the trip</li>
                                </ul>
                                <h4 class="text-base font-semibold">Highlights</h4>
                                <ol class="list-decimal pl-5 space-y-1">
                                    <li>Paddling through narrow cave tunnels into open-air hidden inner lagoons ("hongs") surrounded by sheer cliffs</li>
                                    <li>Marveling at natural limestone stalactites forming shapes of elephants, monkeys, and dragons</li>
                                    <li>Relaxed ocean cruising with air-conditioned lounge areas aboard the primary boat vessel</li>
                                    <li>Direct beach landing on James Bond Island for souvenir photo opportunities</li>
                                </ol>
                                <img src="https://i.pinimg.com/736x/ad/cc/97/adcc972a7453e3045b8a19a1150aca43.jpg" alt="Hong Island sea canoe adventure" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">Good to know</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>No canoeing experience is needed — professional paddlers navigate the canoe for you</li>
                                    <li>Lying completely flat in the canoe is required when passing through low-tide cave entrances</li>
                                    <li>Keep camera gear safely inside provided dry bags during canoe transfers</li>
                                </ul>
                                <p><em>Bring a small gratuity for your dedicated canoe paddle guide who steers you safely through cave passages.</em></p>
                            </div>
                            HTML,
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 3500.00],
                            ['age_group_id' => 2, 'price' => 2500.00],
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
                'start_date' => '2026-05-05',
                'end_date' => '2028-05-05',
                'closing_type' => null,
                'closing_days' => [],
                'countries' => [165],
                'cities' => [15486],
                'categories' => [1],
                'images' => [
                    'https://i.pinimg.com/736x/b5/29/ae/b529ae208c6b77dff504d166f614b281.jpg',
                    'https://i.pinimg.com/736x/a3/ab/3c/a3ab3cc1cb6fa06b43dd88211a46cfbd.jpg',
                    'https://i.pinimg.com/736x/bd/33/03/bd3303ef2bf7e4d2626841986cbb98e4.jpg',
                    'https://i.pinimg.com/736x/40/01/a5/4001a5f7b73739bb0c1f12ee4d4d23c4.jpg',
                    'https://i.pinimg.com/736x/ab/b5/12/abb5122c7ae9c6939ca9cae814c34f84.jpg',
                    'https://i.pinimg.com/736x/51/93/fa/5193fa295d54e67488eba3879cb94e68.jpg',
                    'https://i.pinimg.com/736x/38/97/34/38973446b0dbba2a74f3826521c9eba8.jpg',
                    'https://i.pinimg.com/736x/b4/d0/38/b4d038f61ed18136bec78dee79930489.jpg',
                    'https://i.pinimg.com/736x/a6/14/50/a6145092b25ec13a354e8c373d3545ae.jpg',
                    'https://i.pinimg.com/736x/f0/00/21/f00021c26b101e8f86196af05a39a840.jpg',
                ],
                'packages' => [
                    [
                        'name' => 'Railay Beach Day Trip',
                        'description' => <<<'HTML'
                            <div class="space-y-4">
                                <p>Experience the magical peninsula of Railay with a <strong>Railay Beach Day Trip</strong>. Cut off from the mainland by massive limestone cliffs, Railay is a car-free tropical paradise famous for pristine white sand, dramatic rock climbing crags, sea caves, and relaxed beachside vibes.</p>
                                <img src="https://i.pinimg.com/736x/b5/29/ae/b529ae208c6b77dff504d166f614b281.jpg" alt="Railay Beach Krabi longtail boat view" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">What to expect</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Round-trip longtail boat transfers from Ao Nang Pier or Ao Nam Mao Pier to Railay</li>
                                    <li>Full access to Railay West, Railay East, and world-famous Phra Nang Cave Beach</li>
                                    <li>Exploration of Phra Nang Shrine cave filled with ancient local fisherman offerings</li>
                                    <li>Spectacular viewpoints of towering limestone cliffs framing turquoise waters</li>
                                    <li>Free time for swimming, sunbathing, kayaking, or watching professional rock climbers</li>
                                </ul>
                                <h4 class="text-base font-semibold">Highlights</h4>
                                <ol class="list-decimal pl-5 space-y-1">
                                    <li>Sunbathing on soft white sand at Phra Nang Cave Beach facing emerald sea islands</li>
                                    <li>Trekking up to the steep Railay East Viewpoint for panoramic vistas of both bays</li>
                                    <li>Challenging hike down into the hidden, emerald-green Railay Lagoon (Tonsai)</li>
                                    <li>Watching world-class rock climbers tackle sheer vertical overhangs on Railay West</li>
                                </ol>
                                <img src="https://i.pinimg.com/736x/a3/ab/3c/a3ab3cc1cb6fa06b43dd88211a46cfbd.jpg" alt="Phra Nang Cave Beach limestone cliffs" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">Good to know</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Boarding longtail boats requires stepping into knee-deep water — wear shorts and water sandals</li>
                                    <li>The viewpoint and hidden lagoon trail are extremely steep and muddy; wear shoes with good rubber grip</li>
                                    <li>Monkeys inhabit the cliff trees — keep food, sunglasses, and bags secured</li>
                                </ul>
                                <p><em>Catch the final afternoon longtail boat back to Ao Nang around 18:00 to catch Railay's iconic golden sunset.</em></p>
                            </div>
                            HTML,
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 1600.00],
                            ['age_group_id' => 2, 'price' => 1000.00],
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
                'start_date' => '2026-05-05',
                'end_date' => '2028-05-05',
                'closing_type' => null,
                'closing_days' => [],
                'countries' => [165],
                'cities' => [601],
                'categories' => [1],
                'images' => [
                    'https://i.pinimg.com/736x/b1/a2/e4/b1a2e47bdbbce9d69e66cf5390d1a8c5.jpg',
                    'https://i.pinimg.com/1200x/aa/ad/00/aaad005cabfa927a012b9be5f6679c35.jpg',
                    'https://i.pinimg.com/736x/d8/2a/46/d82a4660c917989843e29a7be99f1c04.jpg',
                    'https://i.pinimg.com/1200x/be/6b/62/be6b624b6d9cb6522e37388b0d1ebd21.jpg',
                    'https://i.pinimg.com/1200x/40/dc/79/40dc7947a0ceb34c6c75043876948dc1.jpg',
                    'https://i.pinimg.com/1200x/79/5d/37/795d379bd940297257786dea51122c60.jpg',
                    'https://i.pinimg.com/736x/89/3b/be/893bbe71dc12dba1e57601fee8fefe3c.jpg',
                    'https://i.pinimg.com/736x/41/4f/4c/414f4c0a219518d03ce644c570b37c84.jpg',
                ],
                'packages' => [
                    [
                        'name' => 'Evening Night Market Tour',
                        'description' => <<<'HTML'
                            <div class="space-y-4">
                                <p>Immerse yourself in Northern Thailand's vibrant night culture with the <strong>Evening Night Market Tour</strong> in Chiang Mai. Accompanied by a knowledgeable local foodie guide, navigate bustling market lanes filled with tribal handicrafts, glowing paper lanterns, live music, and irresistible street food aromas.</p>
                                <img src="https://i.pinimg.com/736x/b1/a2/e4/b1a2e47bdbbce9d69e66cf5390d1a8c5.jpg" alt="Chiang Mai Night Bazaar street market stalls" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">What to expect</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>3-hour guided evening walking tour of Chang Khlan Road Night Bazaar and weekend Walking Streets</li>
                                    <li>Tastings of 6+ authentic Lanna dishes including Khao Soi curry noodles and Sai Oua herbal sausage</li>
                                    <li>Guided introduction to Northern hill tribe art, silverwork, woodcarvings, and woven textiles</li>
                                    <li>Small group walking size (maximum 8 guests) for personalized interaction and ease of moving</li>
                                    <li>Bottled water, herbal drinks, and sweet mango sticky rice dessert included</li>
                                </ul>
                                <h4 class="text-base font-semibold">Highlights</h4>
                                <ol class="list-decimal pl-5 space-y-1">
                                    <li>Sampling rich, creamy coconut Khao Soi noodles at a historic local Lanna street stall</li>
                                    <li>Browsing handcrafted teak wood carvings, silver jewelry, and silk scarves directly from artisans</li>
                                    <li>Watching live traditional Thai dance and acoustic street music performances along the walkways</li>
                                    <li>Discovering hidden temple courtyards transformed into food plazas illuminated by ambient lanterns</li>
                                </ol>
                                <img src="https://i.pinimg.com/1200x/aa/ad/00/aaad005cabfa927a012b9be5f6679c35.jpg" alt="Chiang Mai street food vendor" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">Good to know</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Saturday Walking Street takes place on Wualai Road; Sunday Walking Street spans Ratchadamnoen Road</li>
                                    <li>Polite bargaining is customary for handicrafts, but fixed prices usually apply to street food stalls</li>
                                    <li>Wear comfortable shoes suitable for walking 2–3 kilometers along crowded street paved areas</li>
                                </ul>
                                <p><em>Arrive with an empty stomach — the food tastings equal a very generous full dinner!</em></p>
                            </div>
                            HTML,
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 900.00],
                            ['age_group_id' => 2, 'price' => 500.00],
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
                'start_date' => '2026-05-05',
                'end_date' => '2028-05-05',
                'closing_type' => null,
                'closing_days' => [],
                'countries' => [165],
                'cities' => [601],
                'categories' => [1],
                'images' => [
                    'https://i.pinimg.com/736x/64/91/20/649120a508d11aeb681a24e4ad675e40.jpg',
                    'https://i.pinimg.com/736x/18/9e/2a/189e2aa85c099b979c5bb33263aeb661.jpg',
                    'https://i.pinimg.com/736x/01/32/22/013222de267c933d22a755a806392c92.jpg',
                    'https://i.pinimg.com/736x/4b/b5/71/4bb5716e828011af9df0b1c865912659.jpg',
                    'https://i.pinimg.com/736x/cf/07/a7/cf07a74cd8142ecde8194225241deb02.jpg',
                    'https://i.pinimg.com/736x/13/d2/67/13d26745a0b06614aece477940209e7e.jpg',
                    'https://i.pinimg.com/736x/ce/f1/1a/cef11ada18440bfb2dd412f907e9e192.jpg',
                    'https://i.pinimg.com/736x/d4/07/0c/d4070c1555f1a29e6f48b594ad6f96da.jpg',
                    'https://i.pinimg.com/736x/7e/ba/6b/7eba6ba69e7dcb67ef6e22f72b7c89fe.jpg',
                    'https://i.pinimg.com/736x/c2/c0/1c/c2c01c69c624cdde9d1153902ab29811.jpg',
                ],
                'packages' => [
                    [
                        'name' => 'Full Day Doi Inthanon Tour',
                        'description' => <<<'HTML'
                            <div class="space-y-4">
                                <p>Reach the roof of Thailand with a <strong>Full Day Doi Inthanon Tour</strong>. Standing 2,565 meters above sea level, Doi Inthanon offers cool alpine climate, ancient evergreen moss trails, roaring waterfalls, Karen hill tribe coffee plantations, and the magnificent twin royal chedis built for the King and Queen.</p>
                                <img src="https://i.pinimg.com/736x/64/91/20/649120a508d11aeb681a24e4ad675e40.jpg" alt="Doi Inthanon Twin Royal Pagodas" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">What to expect</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Round-trip air-conditioned transport from Chiang Mai city hotels</li>
                                    <li>Guided nature walk along Ang Ka Cloud Forest Boardwalk at Thailand's highest point peak</li>
                                    <li>2-hour trekking along Kew Mae Pan Nature Trail with a native Karen mountain guide</li>
                                    <li>Visit to Phra Maha Dhatu Naphamethinidon and Naphapholphumsiri Twin Royal Chedis and gardens</li>
                                    <li>Traditional local lunch and fresh organic coffee tasting at a White Karen village</li>
                                    <li>Photographic stops at Wachirathan and Sirithan thunderous waterfalls</li>
                                </ul>
                                <h4 class="text-base font-semibold">Highlights</h4>
                                <ol class="list-decimal pl-5 space-y-1">
                                    <li>Standing at the official summit marker sign of Thailand's highest mountain peak (2,565m)</li>
                                    <li>Walking high mountain ridge paths with panoramic views over sea-of-clouds mountain valleys</li>
                                    <li>Exploring immaculate terraced flower gardens surrounding the marble and gold Royal Pagodas</li>
                                    <li>Feeling the refreshing cool spray of Wachirathan Waterfall cascading down 80 meters of granite rock</li>
                                </ol>
                                <img src="https://i.pinimg.com/736x/18/9e/2a/189e2aa85c099b979c5bb33263aeb661.jpg" alt="Wachirathan Waterfall Doi Inthanon" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">Good to know</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>The summit temperatures range between 5°C and 15°C year-round — bring a warm light jacket or sweater</li>
                                    <li>Kew Mae Pan trail is closed for forest recovery from June 1 to October 31 annually</li>
                                    <li>Sturdy sneakers or hiking shoes are required for uneven forest trails and stairs</li>
                                </ul>
                                <p><em>Buy a bag of fresh roasted arabica coffee beans directly at the Karen hill tribe farm to support local agriculture.</em></p>
                            </div>
                            HTML,
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 2300.00],
                            ['age_group_id' => 2, 'price' => 1600.00],
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
                'start_date' => '2026-05-05',
                'end_date' => '2028-05-05',
                'closing_type' => null,
                'closing_days' => [],
                'countries' => [165],
                'cities' => [19074],
                'categories' => [1],
                'images' => [
                    'https://i.pinimg.com/736x/19/ac/9d/19ac9dce866049073c9dbba0f0d8ffa5.jpg',
                    'https://i.pinimg.com/736x/f7/72/e6/f772e6d4d69a38715cec70f894396292.jpg',
                    'https://i.pinimg.com/736x/9c/31/d3/9c31d32976f52de4970fd884e1de2075.jpg',
                    'https://i.pinimg.com/736x/7e/9d/9f/7e9d9ff52ef66ae7813300860543144c.jpg',
                    'https://i.pinimg.com/736x/72/f1/3c/72f13cee1eb0dce14d8bd48e78e2a167.jpg',
                    'https://i.pinimg.com/736x/f9/2f/b6/f92fb61c0c05d78c87726927f21bba3.jpg',
                    'https://i.pinimg.com/736x/ab/74/dd/ab74ddfdd035bced569c92a116d7820a.jpg',
                    'https://i.pinimg.com/736x/86/07/8c/86078c70bed4e6a9ffcf4bbb0b723feb.jpg',
                    'https://i.pinimg.com/736x/78/29/84/7829841dad96d7c5fb2b7662321fddee.jpg',
                    'https://i.pinimg.com/736x/fc/1d/3b/fc1d3bb67539b24e1f0a73cf4f603488.jpg',
                ],
                'packages' => [
                    [
                        'name' => 'Erawan Day Trip from Bangkok',
                        'description' => <<<'HTML'
                            <div class="space-y-4">
                                <p>Hike through lush jungle paradise on an <strong>Erawan Day Trip from Bangkok</strong>. Famous for its seven-tiered emerald green water pools fed by limestone spring streams, Erawan Waterfall in Kanchanaburi offers natural water slides, refreshing swimming holes, and scenic rainforest trails.</p>
                                <img src="https://i.pinimg.com/736x/19/ac/9d/19ac9dce866049073c9dbba0f0d8ffa5.jpg" alt="Erawan Seven Tier Waterfall emerald pool" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">What to expect</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Comfortable round-trip private transport from Bangkok to Kanchanaburi (approx. 3 hours each way)</li>
                                    <li>Full 3.5 hours of free time inside Erawan National Park to hike, swim, and relax</li>
                                    <li>National park entrance fees, life jacket rental, and park environmental passes included</li>
                                    <li>Delicious Thai set lunch at a local restaurant near the park entrance</li>
                                    <li>Bonus visit to the historic River Kwai Bridge in Kanchanaburi town</li>
                                </ul>
                                <h4 class="text-base font-semibold">Highlights</h4>
                                <ol class="list-decimal pl-5 space-y-1">
                                    <li>Swimming in crystal-clear emerald limestone pools at Tier 2 (Wang Macha) and Tier 3 (Pha Namtok)</li>
                                    <li>Sliding down natural smooth rock water slides at Tier 4 (Ok Nank Phee)</li>
                                    <li>Conquering the full 1.5 km jungle trail up to Tier 7 (Phu Pha Erawan) shaped like a 3-headed elephant</li>
                                    <li>Experiencing the natural "fish spa" as doctor fish gently nibble your feet in the water</li>
                                </ol>
                                <img src="https://i.pinimg.com/736x/f7/72/e6/f772e6d4d69a38715cec70f894396292.jpg" alt="Erawan Waterfall jungle pool swim" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">Good to know</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Plastic water bottles are strictly registered and require a 20 THB deposit above Tier 2 to prevent littering</li>
                                    <li>Life jackets are mandatory for swimming in deep pool zones and can be rented at Tier 1</li>
                                    <li>Trails above Tier 4 become steep dirt and bamboo steps — wear sports shoes or sandals with heel straps</li>
                                </ul>
                                <p><em>Head straight up to Tiers 5–7 early in the morning for quiet swimming pools before group tours arrive at Tier 2.</em></p>
                            </div>
                            HTML,
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 1900.00],
                            ['age_group_id' => 2, 'price' => 1200.00],
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
                'start_date' => '2026-05-05',
                'end_date' => '2028-05-05',
                'closing_type' => null,
                'closing_days' => [],
                'countries' => [165],
                'cities' => [7880],
                'categories' => [1],
                'images' => [
                    'https://i.pinimg.com/736x/b4/20/14/b4201417a2df2bde790cb4b121e71073.jpg',
                    'https://i.pinimg.com/736x/0e/39/a2/0e39a2b2795d0fb7b6740c8f851984e0.jpg',
                    'https://i.pinimg.com/736x/b2/cc/60/b2cc60a7231d797677398b5df3621789.jpg',
                    'https://i.pinimg.com/736x/7a/78/6a/7a786ad288f66402916fe131095c2ba3.jpg',
                    'https://i.pinimg.com/736x/ef/45/a7/ef45a739f7c0858251499758a12d3470.jpg',
                    'https://i.pinimg.com/736x/18/ec/fc/18ecfcb904f5b99c9d7a5be6eb376fb1.jpg',
                    'https://i.pinimg.com/736x/c6/b6/1d/c6b61dfebbf05b6b99182354eea38bbb.jpg',
                    'https://i.pinimg.com/736x/0d/8f/7f/0d8f7f223fe5e78e4cc88ba85cc05a62.jpg',
                    'https://i.pinimg.com/736x/48/9a/b1/489ab16cadf233ad270b3887a50d9b2a.jpg',
                    'https://i.pinimg.com/736x/6e/58/f3/6e58f346b349b9330b35b7ca02699017.jpg',
                ],
                'packages' => [
                    [
                        'name' => 'Island Highlights Half Day',
                        'description' => <<<'HTML'
                            <div class="space-y-4">
                                <p>See the absolute best of Koh Samui in a single effortless outing with the <strong>Island Highlights Half Day</strong> tour. From giant golden statues and sacred mummified monks to dramatic coastal rock formations and panoramic hill viewpoints, experience the culture and scenery of Thailand's premier tropical island.</p>
                                <img src="https://i.pinimg.com/736x/b4/20/14/b4201417a2df2bde790cb4b121e71073.jpg" alt="Big Buddha Temple Wat Phra Yai Koh Samui" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">What to expect</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Air-conditioned minibus pick-up and drop-off directly at your Koh Samui hotel</li>
                                    <li>Guided visits to Wat Phra Yai (Big Buddha) and Wat Plai Laem 18-armed Guan Yin temple</li>
                                    <li>Photo stops at Hin Ta and Hin Yai (Grandfather & Grandmother rocks) natural seaside formations</li>
                                    <li>Visit to Wat Khunaram to pay respects to the famous Mummified Monk (Luang Pho Daeng)</li>
                                    <li>Stop at Na Muang 1 Waterfall and Lad Koh high cliff viewpoint overlooking Chaweng Bay</li>
                                </ul>
                                <h4 class="text-base font-semibold">Highlights</h4>
                                <ol class="list-decimal pl-5 space-y-1">
                                    <li>Climbing the dragon staircase to the 12-meter golden Big Buddha sitting on an island hill</li>
                                    <li>Marveling at the striking multi-armed statue of Guan Yin standing on a lotus lake at Wat Plai Laem</li>
                                    <li>Taking photos at the picturesque ocean cliffs of Hin Ta & Hin Yai</li>
                                    <li>Refreshing under the cool spray of Na Muang Waterfall surrounded by lush Samui jungle</li>
                                </ol>
                                <img src="https://i.pinimg.com/736x/0e/39/a2/0e39a2b2795d0fb7b6740c8f851984e0.jpg" alt="Wat Plai Laem multi-armed Guan Yin Koh Samui" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">Good to know</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Modest dress (shoulders and knees covered) is required at Big Buddha and Wat Plai Laem temples</li>
                                    <li>Shoes must be removed before ascending the temple platform steps</li>
                                    <li>Tasting local coconut ice cream served in real coconut shells at Hin Ta Hin Yai is highly recommended</li>
                                </ul>
                                <p><em>The morning tour option avoids midday heat and offers bright daylight for photos at Lad Koh Viewpoint.</em></p>
                            </div>
                            HTML,
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 1400.00],
                            ['age_group_id' => 2, 'price' => 900.00],
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
                'start_date' => '2026-05-05',
                'end_date' => '2028-05-05',
                'closing_type' => null,
                'closing_days' => [],
                'countries' => [165],
                'cities' => [19074],
                'categories' => [1],
                'images' => [
                    'https://i.pinimg.com/736x/62/9a/c8/629ac8ebe6f83a297d9cba4e687ef4a8.jpg',
                    'https://i.pinimg.com/736x/f0/5e/5e/f05e5ee2db457eb181e91dc71f0af591.jpg',
                    'https://i.pinimg.com/736x/2e/9b/fb/2e9bfb4f39eb9018fc46a368a2871c2d.jpg',
                    'https://i.pinimg.com/736x/83/f7/bd/83f7bd66a07cfbe915849f9b766f5376.jpg',
                    'https://i.pinimg.com/736x/5c/64/25/5c6425692ba1d33a104617c08b603f33.jpg',
                    'https://i.pinimg.com/736x/43/87/b7/4387b76db6d483214bca7689dfb51f2e.jpg',
                    'https://i.pinimg.com/736x/a3/59/c6/a359c6530473de308ac0b59663ed243f.jpg',
                    'https://i.pinimg.com/736x/85/f9/fb/85f9fbe93112eccabc72ca67a507f9dd.jpg',
                    'https://i.pinimg.com/736x/0b/14/6e/0b146e91db9b64886f2d04b8b4f2627d.jpg',
                    'https://i.pinimg.com/736x/1b/56/93/1b569351a83f67b8a65c80984e4becbe.jpg',
                ],
                'packages' => [
                    [
                        'name' => 'Kanchanaburi History Day Trip',
                        'description' => <<<'HTML'
                            <div class="space-y-4">
                                <p>Step back into World War II history on a <strong>Kanchanaburi History Day Trip</strong>. Visit the iconic Bridge over the River Kwai, ride an authentic wooden train along the cliffside Death Railway trestles, and pay solemn tribute at the JEATH War Museum and Allied War Cemetery.</p>
                                <img src="https://i.pinimg.com/736x/62/9a/c8/629ac8ebe6f83a297d9cba4e687ef4a8.jpg" alt="Bridge over the River Kwai Kanchanaburi" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">What to expect</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Round-trip air-conditioned minivan transfer from central Bangkok</li>
                                    <li>Guided walk across the historic iron-arched Bridge over the River Kwai</li>
                                    <li>Scenic 45-minute ride on the historic Thailand-Burma Death Railway train line</li>
                                    <li>Guided tour of JEATH War Museum containing POW artifacts, photos, and bamboo hut replicas</li>
                                    <li>Respectful visit to Kanchanaburi War Cemetery (Don-Rak) honoring nearly 7,000 Allied soldiers</li>
                                    <li>Buffet lunch served at a floating riverside restaurant near the bridge</li>
                                </ul>
                                <h4 class="text-base font-semibold">Highlights</h4>
                                <ol class="list-decimal pl-5 space-y-1">
                                    <li>Walking along the iron bridge tracks with open views across the Kwai Yai River</li>
                                    <li>Riding the train as it slowly inches along dramatic wooden cliff trestles hugging the Kwai Noi cliff face at Tham Krasae</li>
                                    <li>Inspecting original war relics, maps, and weapons at the JEATH Museum galleries</li>
                                    <li>Learning poignant historical stories of POW endurance and engineering feats from your expert historian guide</li>
                                </ol>
                                <img src="https://i.pinimg.com/736x/f0/5e/5e/f05e5ee2db457eb181e91dc71f0af591.jpg" alt="Death Railway train on cliffside wooden trestles" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">Good to know</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Active trains still pass over the River Kwai Bridge 4 times daily — step into safety side-platforms when bells ring</li>
                                    <li>Train carriages feature open windows (non-air-conditioned) for authentic atmospheric views; sit on the left side for the best cliff views</li>
                                    <li>Sun protection and hats are recommended when walking across the open metal bridge structure</li>
                                </ul>
                                <p><em>Combine this tour with an overnight floating raft house stay in Kanchanaburi for a deeply memorable weekend getaway.</em></p>
                            </div>
                            HTML,
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 1700.00],
                            ['age_group_id' => 2, 'price' => 1000.00],
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
                'start_date' => '2026-05-05',
                'end_date' => '2028-05-05',
                'closing_type' => ClosingTypeEnum::CLOSING_DAYS->value,
                'closing_days' => ['Sunday'],
                'countries' => [165],
                'cities' => [17],
                'categories' => [1],
                'images' => [
                    'https://i.pinimg.com/1200x/4f/f3/d2/4ff3d24c5e12d0f9a23d7f71d44dae0f.jpg',
                    'https://i.pinimg.com/1200x/50/78/e3/5078e3b30a820ade2a79d2137549fad2.jpg',
                    'https://i.pinimg.com/736x/52/b6/85/52b6857d303c025aa8b9249dc1bd1f72.jpg',
                    'https://i.pinimg.com/736x/a5/9e/df/a59edf687f047b53cfe9a07c22365483.jpg',
                    'https://i.pinimg.com/1200x/c4/7e/58/c47e58307906d9f544c4a7f47bb344d2.jpg',
                ],
                'packages' => [
                    [
                        'name' => 'Ringside Seat Ticket',
                        'description' => <<<'HTML'
                            <div class="space-y-4">
                                <p>Feel the raw energy and thunderous impacts right from the front row with a <strong>Ringside Seat Ticket</strong> for live Muay Thai at Bangkok's premier stadium. Sit mere feet from the ring, hear every strike, observe intricate pre-bout rituals up close, and enjoy photo access with winning fighters.</p>
                                <img src="https://i.pinimg.com/1200x/4f/f3/d2/4ff3d24c5e12d0f9a23d7f71d44dae0f.jpg" alt="Muay Thai boxing match ringside action" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">What to expect</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Guaranteed VIP front-row ringside chair seating directly around the canvas ring</li>
                                    <li>Access to 7 to 9 full professional Muay Thai fights featuring international and top Thai fighters</li>
                                    <li>Up-close observation of the sacred Wai Kru Ram Muay pre-fight homage ritual and Sarama live music</li>
                                    <li>Exclusive post-fight photo opportunity inside or alongside the ring with winning champions</li>
                                    <li>Complimentary beer or soft drink voucher and souvenir event poster</li>
                                </ul>
                                <h4 class="text-base font-semibold">Highlights</h4>
                                <ol class="list-decimal pl-5 space-y-1">
                                    <li>Unobstructed view of high-level martial arts technique: knees, elbows, sweeps, and knockout kicks</li>
                                    <li>Experiencing the hypnotic rhythms of live Sarama musical instruments (Java pipe, drums, cymbals) accelerating during bout climaxes</li>
                                    <li>Immersing yourself in the passionate cheering and electric atmosphere of traditional Thai fight fans</li>
                                    <li>Capturing crystal-clear photos and videos without stadium mesh or crowd obstructions</li>
                                </ol>
                                <img src="https://i.pinimg.com/1200x/50/78/e3/5078e3b30a820ade2a79d2137549fad2.jpg" alt="Muay Thai fighter ritual Wai Kru" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">Good to know</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Ringside seats place you very close to sweat and action — wear comfortable casual clothing</li>
                                    <li>Doors open at 17:30 PM; fights begin promptly at 18:00 PM and finish around 21:30 PM</li>
                                    <li>Stadiums are fully air-conditioned and feature food and beverage stalls</li>
                                </ul>
                                <p><em>Ringside tickets are strictly limited per fight night — early advance booking is essential.</em></p>
                            </div>
                            HTML,
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 1750.00],
                            ['age_group_id' => 2, 'price' => 1200.00],
                        ],
                    ],
                    [
                        'name' => 'Standard Seat Ticket',
                        'description' => <<<'HTML'
                            <div class="space-y-4">
                                <p>Soak up authentic fight night energy with a <strong>Standard Seat Ticket</strong> for live Muay Thai boxing in Bangkok. Elevated grandstand seating provides a complete overhead view of the entire ring and surrounding stadium, letting you feel part of the passionate local fan section.</p>
                                <img src="https://i.pinimg.com/736x/52/b6/85/52b6857d303c025aa8b9249dc1bd1f72.jpg" alt="Muay Thai stadium seating atmosphere" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">What to expect</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Elevated grandstand seating ticket with clear full-ring sightlines</li>
                                    <li>Admission to the complete card of 7 to 9 official sanctioned professional bouts</li>
                                    <li>Live musical accompaniment by traditional Thai fight bands throughout the night</li>
                                    <li>Access to stadium food counters serving snacks, cold beers, and soft drinks</li>
                                </ul>
                                <h4 class="text-base font-semibold">Highlights</h4>
                                <ol class="list-decimal pl-5 space-y-1">
                                    <li>Viewing complete strategic footwork and ring movement from an elevated stadium angle</li>
                                    <li>Soaking in the vibrant atmosphere of local Thai spectators calling out scores and odds</li>
                                    <li>Watching rising young boxing stars clash for championship belt rankings</li>
                                    <li>Witnessing the ancient ceremonial blessing rituals performed before each bout</li>
                                </ol>
                                <img src="https://i.pinimg.com/736x/a5/9e/df/a59edf687f047b53cfe9a07c22365483.jpg" alt="Bangkok Muay Thai stadium night" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">Good to know</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Standard seating is unreserved within designated grandstand tiers — arrive early for central seat positions</li>
                                    <li>Stadium security performs bag checks at entrance gates; professional zoom camera lenses may require permission</li>
                                    <li>Children under 12 receive discounted standard seat pricing</li>
                                </ul>
                                <p><em>An excellent budget-friendly choice to experience authentic Thai martial arts culture live in Bangkok.</em></p>
                            </div>
                            HTML,
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 900.00],
                            ['age_group_id' => 2, 'price' => 500.00],
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
                'start_date' => '2026-05-05',
                'end_date' => '2028-05-05',
                'closing_type' => null,
                'closing_days' => [],
                'countries' => [165],
                'cities' => [17],
                'categories' => [1],
                'images' => [
                    'https://i.pinimg.com/736x/d8/cb/72/d8cb72f96581c1a9b02b8801f6ea3db6.jpg',
                    'https://i.pinimg.com/736x/7d/86/b0/7d86b0088d04337045399998d5e17c95.jpg',
                    'https://i.pinimg.com/736x/16/d3/15/16d315919faf905503262aae500dbef1.jpg',
                    'https://i.pinimg.com/736x/12/b6/dc/12b6dcce77d191f26bd5ee5d93f8706d.jpg',
                    'https://i.pinimg.com/736x/38/24/17/382417f068719035e32e1301f6e9e2c1.jpg',
                    'https://i.pinimg.com/736x/1e/18/c8/1e18c8a783a0d88a7b62279e449010ad.jpg',
                    'https://i.pinimg.com/736x/2a/25/b4/2a25b4834e69d173aa1786fe0428e840.jpg',
                    'https://i.pinimg.com/736x/cb/0d/35/cb0d35085bec3fbce5294a6bd5cc4936.jpg',
                    'https://i.pinimg.com/736x/0d/93/7b/0d937b18054d8ec91f379486df34ec65.jpg',
                    'https://i.pinimg.com/736x/c7/6b/1a/c76b1aa5398296c8ee545e683c5810a6.jpg',
                ],
                'packages' => [
                    [
                        'name' => 'Half Day Cooking Class',
                        'description' => <<<'HTML'
                            <div class="space-y-4">
                                <p>Master the secrets of Thai flavor balance (sweet, sour, salty, spicy) with a hands-on <strong>Half Day Cooking Class</strong> in Bangkok. Visit a local fresh market to handpick herbs and spices, then prepare four iconic authentic Thai dishes under the guidance of a warm professional master chef.</p>
                                <img src="https://i.pinimg.com/736x/d8/cb/72/d8cb72f96581c1a9b02b8801f6ea3db6.jpg" alt="Thai cooking class ingredients preparation" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">What to expect</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Guided walking tour of a traditional wet market to learn about Thai herbs, chilies, galangal, and coconut milk</li>
                                    <li>Individual cooking station equipped with gas wok, chopping board, apron, and utensils</li>
                                    <li>Step-by-step instruction to cook 4 full dishes (e.g., Tom Yum Goong, Green Curry, Pad Thai, Mango Sticky Rice)</li>
                                    <li>Making curry paste completely from scratch using stone mortar and pestle</li>
                                    <li>Enjoying your own delicious home-cooked creations in a air-conditioned dining room</li>
                                    <li>Color printed recipe booklet and digital certificate to take home</li>
                                </ul>
                                <h4 class="text-base font-semibold">Highlights</h4>
                                <ol class="list-decimal pl-5 space-y-1">
                                    <li>Pounding fresh galangal, lemongrass, and kaffir lime leaves into fragrant handmade green curry paste</li>
                                    <li>Mastering high-heat wok tossing technique for smoky street-style Pad Thai noodles</li>
                                    <li>Learning how to adjust chili spice levels perfectly to your personal taste preference</li>
                                    <li>Savoring sweet warm coconut sticky rice paired with ripe mango slices for dessert</li>
                                </ol>
                                <img src="https://i.pinimg.com/736x/7d/86/b0/7d86b0088d04337045399998d5e17c95.jpg" alt="Cooking Pad Thai in wok class" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">Good to know</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Vegetarian, vegan, halal, and nut-allergy dietary options are readily accommodated with substitute ingredients</li>
                                    <li>Morning classes include market tours; afternoon classes focus on extended kitchen techniques and vegetable carving</li>
                                    <li>No prior culinary experience is needed — suitable for absolute beginners and food lovers alike</li>
                                </ul>
                                <p><em>Skip breakfast before morning class — eating your four cooked courses equals a very filling feast!</em></p>
                            </div>
                            HTML,
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 1600.00],
                            ['age_group_id' => 2, 'price' => 1050.00],
                        ],
                    ],
                    [
                        'name' => 'Full Day Cooking Class',
                        'description' => <<<'HTML'
                            <div class="space-y-4">
                                <p>Become a true master of Royal Thai cuisine with the comprehensive <strong>Full Day Cooking Class</strong> in Bangkok. Prepare six legendary Thai dishes from scratch, master intricate fruit carving artistry, visit an organic herb garden, and gain deep culinary knowledge that will impress dinner guests back home.</p>
                                <img src="https://i.pinimg.com/736x/16/d3/15/16d315919faf905503262aae500dbef1.jpg" alt="Thai culinary class wok cooking feast" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">What to expect</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>In-depth morning market tour and organic herb garden harvesting session</li>
                                    <li>Hands-on preparation of 6 complete courses spanning appetizers, soups, curries, stir-fries, and desserts</li>
                                    <li>Specialized lesson on traditional Thai fruit and vegetable carving techniques (kae sa luk)</li>
                                    <li>Making two distinct curry pastes from scratch (Red Curry and Massaman Curry)</li>
                                    <li>Complimentary welcome drink, herb teas, apron to take home, and full master recipe book</li>
                                </ul>
                                <h4 class="text-base font-semibold">Highlights</h4>
                                <ol class="list-decimal pl-5 space-y-1">
                                    <li>Slow-simmering tender Massaman beef curry infused with roasted spices, peanuts, and potatoes</li>
                                    <li>Creating delicate watermelon and cucumber rose flowers during the fruit carving workshop</li>
                                    <li>Cooking spicy Som Tam papaya salad pounded in a traditional wooden mortar</li>
                                    <li>Receiving a personal diploma certificate signed by your master Thai chef instructor</li>
                                </ol>
                                <img src="https://i.pinimg.com/736x/12/b6/dc/12b6dcce77d191f26bd5ee5d93f8706d.jpg" alt="Fresh Thai herbs and ingredients market" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">Good to know</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Full day class runs from 09:00 AM to 15:30 PM with relaxed dining breaks between cooking modules</li>
                                    <li>Comfortable loose-fitting clothing and flat closed-toe shoes are recommended in the kitchen</li>
                                    <li>Takeaway containers are provided if you cannot finish eating all six prepared courses on site</li>
                                </ul>
                                <p><em>The ultimate experience for passionate foodies who want to bring authentic Thai culinary techniques home.</em></p>
                            </div>
                            HTML,
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 2600.00],
                            ['age_group_id' => 2, 'price' => 1750.00],
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
                'start_date' => '2026-05-05',
                'end_date' => '2028-05-05',
                'closing_type' => null,
                'closing_days' => [],
                'countries' => [165],
                'cities' => [17],
                'categories' => [1],
                'images' => [
                    'https://i.pinimg.com/736x/62/1a/f2/621af25016f79eafe15bc16ea8df7b05.jpg',
                    'https://i.pinimg.com/736x/f6/c6/a8/f6c6a8792ecc8acf44f990e36b76377d.jpg',
                    'https://i.pinimg.com/736x/7c/64/be/7c64be2fb7013f9b5d07fe7bf2484509.jpg',
                    'https://i.pinimg.com/736x/63/16/27/63162773c16a1357657ca2f1f2e7285a.jpg',
                    'https://i.pinimg.com/736x/33/3a/78/333a786ec45f4d075f154d8da7bc6e81.jpg',
                    'https://i.pinimg.com/736x/81/52/1c/81521c113f209219653c0ff1363d0b13.jpg',
                    'https://i.pinimg.com/736x/b0/c2/50/b0c25081cb6e487f51d8794aea7a4329.jpg',
                    'https://i.pinimg.com/736x/77/32/5d/77325d96c45b807fecb32fb6b94ffa6a.jpg',
                    'https://i.pinimg.com/736x/02/94/81/0294813f2a61e1bcf5e5b1734e0271b2.jpg',
                ],
                'packages' => [
                    [
                        'name' => 'Self-Guided Cycling Tour',
                        'description' => <<<'HTML'
                            <div class="space-y-4">
                                <p>Pedal through centuries of ancient history with a <strong>Self-Guided Cycling Tour</strong> of Sukhothai Historical Park. As the 13th-century first capital of Siam, UNESCO World Heritage Sukhothai features flat paved bicycle paths winding past serene lotus moats, giant stone Buddha statues, and majestic bell-shaped chedis.</p>
                                <img src="https://i.pinimg.com/736x/62/1a/f2/621af25016f79eafe15bc16ea8df7b05.jpg" alt="Sukhothai Historical Park cycling near temple ruins" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">What to expect</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>All-day comfortable city bicycle rental equipped with front basket, helmet, and lock</li>
                                    <li>Detailed waterproof historical map and recommended cycling route itineraries</li>
                                    <li>Access to Central, North, and West zones of Sukhothai Historical Park</li>
                                    <li>Self-paced exploration of over 190 historical temple ruins across 70 square kilometers</li>
                                </ul>
                                <h4 class="text-base font-semibold">Highlights</h4>
                                <ol class="list-decimal pl-5 space-y-1">
                                    <li>Cycling across wooden bridges over lotus-filled moats surrounding Wat Mahathat</li>
                                    <li>Gazing up at the colossal 15-meter seated Buddha enclosed inside narrow brick walls at Wat Si Chum</li>
                                    <li>Discovering Khmer-style prangs at Wat Phra Phai Luang in the quieter Northern zone</li>
                                    <li>Watching the sunset cast golden light across the reflection pond at Wat Sa Si</li>
                                </ol>
                                <img src="https://i.pinimg.com/736x/f6/c6/a8/f6c6a8792ecc8acf44f990e36b76377d.jpg" alt="Wat Si Chum giant Buddha Sukhothai" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">Good to know</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Park terrain is almost completely flat and car-free — extremely safe and easy for all fitness levels</li>
                                    <li>Entrance passes are sold separately for each park zone (100 THB per zone + 10 THB bicycle fee)</li>
                                    <li>Sun protection, sunglasses, hats, and bottled water are essential on open sunlit paths</li>
                                </ul>
                                <p><em>Rent your bike at 06:30 AM to enter the park right as gates open for peaceful, cool morning cycling.</em></p>
                            </div>
                            HTML,
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 650.00],
                            ['age_group_id' => 2, 'price' => 350.00],
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
                'start_date' => '2026-05-05',
                'end_date' => '2028-05-05',
                'closing_type' => null,
                'closing_days' => [],
                'countries' => [165],
                'cities' => [1962],
                'categories' => [1],
                'images' => [
                    'https://i.pinimg.com/736x/5a/d2/29/5ad22925443405181af883a9f0167bff.jpg',
                    'https://i.pinimg.com/736x/32/06/f9/3206f9d4ff536937e3bc00fc0b7286e0.jpg',
                    'https://i.pinimg.com/736x/c4/24/09/c42409aff7c34c1ba6ace473d44f04ba.jpg',
                    'https://i.pinimg.com/736x/f3/d7/be/f3d7be74c748753370eb3764a3be86be.jpg',
                    'https://i.pinimg.com/736x/3e/5c/25/3e5c255a6694b0da93ad6328dae064d5.jpg',
                    'https://i.pinimg.com/736x/cf/8c/88/cf8c8827270d97068c5d748993646f6e.jpg',
                    'https://i.pinimg.com/736x/ee/22/4f/ee224f349b76ccca076688ade43eb995.jpg',
                    'https://i.pinimg.com/736x/a6/4f/5d/a64f5dec0b7a59f5e02d4cd58c5105d1.jpg',
                    'https://i.pinimg.com/736x/44/a3/d9/44a3d994694ac1679ff6f42f51658ba8.jpg',
                ],
                'packages' => [
                    [
                        'name' => 'Garden Admission + Cultural Show',
                        'description' => <<<'HTML'
                            <div class="space-y-4">
                                <p>Explore 500 acres of botanical grandeur with the <strong>Garden Admission + Cultural Show</strong> package at Nong Nooch Tropical Garden in Pattaya. Renowned as one of the world's top ten beautiful gardens, discover manicured French topiary, orchid nurseries, life-sized dinosaur sculptures, and spectacular live Thai cultural performances.</p>
                                <img src="https://i.pinimg.com/736x/5a/d2/29/5ad22925443405181af883a9f0167bff.jpg" alt="Nong Nooch Tropical Garden French Topiary" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">What to expect</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Full-day admission to all 30 themed botanical garden zones including French Garden and Stonehenge Garden</li>
                                    <li>Reserved seating ticket for the 45-minute indoor Thai Cultural Extravaganza show</li>
                                    <li>Access to Dinosaur Valley featuring over 300 hyper-realistic life-sized dinosaur models</li>
                                    <li>Entry to the world-class Orchid and Bromeliad conservatories</li>
                                    <li>Complimentary access to skywalk elevated canopy viewing bridges</li>
                                </ul>
                                <h4 class="text-base font-semibold">Highlights</h4>
                                <ol class="list-decimal pl-5 space-y-1">
                                    <li>Marveling at perfectly symmetrical geometric lawns in the replica French & Italian Gardens</li>
                                    <li>Watching traditional Lanna drum dances, Muay Thai mock fights, and royal procession spectacles in the air-conditioned theater</li>
                                    <li>Walking amongst giant T-Rex and Triceratops statues in Dinosaur Valley</li>
                                    <li>Admiring thousands of rare tropical blooming orchids in vibrant purples, golds, and whites</li>
                                </ol>
                                <img src="https://i.pinimg.com/736x/32/06/f9/3206f9d4ff536937e3bc00fc0b7286e0.jpg" alt="Nong Nooch Orchid Garden Pattaya" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">Good to know</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>The garden area is huge (500 acres) — hop-on hop-off shuttle bus passes can be purchased inside for easy transit</li>
                                    <li>Cultural shows run four times daily (10:30, 11:30, 13:30, 15:30) — check-in 15 minutes before showtime</li>
                                    <li>Wheelchair and stroller friendly paved elevated skywalk pathways span across the main garden zones</li>
                                </ul>
                                <p><em>Walk the elevated Skywalk bridge for the best aerial panoramic photos over the French Garden lawns.</em></p>
                            </div>
                            HTML,
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 700.00],
                            ['age_group_id' => 2, 'price' => 400.00],
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
                'start_date' => '2026-05-05',
                'end_date' => '2028-05-05',
                'closing_type' => null,
                'closing_days' => [],
                'countries' => [165],
                'cities' => [1962],
                'categories' => [1],
                'images' => [
                    'https://i.pinimg.com/736x/ae/fe/51/aefe51976e17bb761c80aae17733c958.jpg',
                    'https://i.pinimg.com/1200x/28/0d/19/280d1927fece32d7dcb8029589f6f845.jpg',
                    'https://i.pinimg.com/736x/6a/78/93/6a78938ecb5bbcae91cd45f52babf672.jpg',
                    'https://i.pinimg.com/736x/04/63/4f/04634f99828b802db63b1a1c4e93e33e.jpg',
                    'https://i.pinimg.com/736x/c3/c7/ef/c3c7eff06dbc85e808d3eca0142161b5.jpg',
                    'https://i.pinimg.com/736x/9d/8e/af/9d8eaf98d2dc0c2025775284e3cd08f3.jpg',
                    'https://i.pinimg.com/736x/0f/d6/8c/0fd68c126009999e68be0e7ecdd2842b.jpg',
                    'https://i.pinimg.com/736x/d9/85/62/d98562e587eb7fee6f6996768a5f9bda.jpg',
                ],
                'packages' => [
                    [
                        'name' => 'Sanctuary Entrance Ticket',
                        'description' => <<<'HTML'
                            <div class="space-y-4">
                                <p>Witness a architectural marvel with a <strong>Sanctuary Entrance Ticket</strong> to Pattaya's Sanctuary of Truth (Prasat Sut Ja-Tum). Standing 105 meters tall on the edge of the ocean, this colossal hand-carved teak wooden castle is constructed entirely without metal nails, honoring ancient Asian philosophy and craftsmanship.</p>
                                <img src="https://i.pinimg.com/736x/ae/fe/51/aefe51976e17bb761c80aae17733c958.jpg" alt="Sanctuary of Truth carved wooden temple Pattaya" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">What to expect</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Admission ticket to the Sanctuary of Truth castle grounds and beachside complex</li>
                                    <li>30-minute guided walk inside the main wooden hall available in English, Chinese, or Russian</li>
                                    <li>Access to active woodcarving workshops where master artisans hand-chisel sculptures</li>
                                    <li>Entry to traditional Thai dance and sword fighting performances (11:30 AM & 15:30 PM daily)</li>
                                    <li>Complimentary hard hat safety helmet required while touring active handcraft zones</li>
                                </ul>
                                <h4 class="text-base font-semibold">Highlights</h4>
                                <ol class="list-decimal pl-5 space-y-1">
                                    <li>Examining intricate 4-faced Brahma carvings, sea deities, and mythic figures carved into every inch of teak timber</li>
                                    <li>Learning how traditional wooden tongue-and-groove joints hold the 105-meter building together without a single nail</li>
                                    <li>Watching master woodcarvers actively sculpting new wooden pillars and relief panels</li>
                                    <li>Capturing breathtaking photos of the wooden spires framing the blue waters of the Gulf of Thailand</li>
                                </ol>
                                <img src="https://i.pinimg.com/1200x/28/0d/19/280d1927fece32d7dcb8029589f6f845.jpg" alt="Intricate carved teak wood details Sanctuary of Truth" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">Good to know</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>As a sacred place of philosophy, modest attire is required (shoulders and knees covered; sarongs available for rent)</li>
                                    <li>Hard hats must be worn inside the main castle sanctuary as skilled maintenance work is ongoing</li>
                                    <li>Optional boat rides, horse carriage rides, and elephant feeding activities are available on-site for extra fees</li>
                                </ul>
                                <p><em>Visit around 16:30 PM for gorgeous golden light reflecting off the carved teak wood against the sea sunset.</em></p>
                            </div>
                            HTML,
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 750.00],
                            ['age_group_id' => 2, 'price' => 400.00],
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
                'start_date' => '2026-05-05',
                'end_date' => '2028-05-05',
                'closing_type' => null,
                'closing_days' => [],
                'countries' => [165],
                'cities' => [15486],
                'categories' => [1],
                'images' => [
                    'https://i.pinimg.com/736x/35/d9/6a/35d96aae8437565d8842eb21867165a5.jpg',
                    'https://i.pinimg.com/736x/51/78/71/517871a30cdf85ceb0f32211d8a337b5.jpg',
                    'https://i.pinimg.com/736x/bf/f7/ab/bff7abec1fe9d69aae673348b5c072d5.jpg',
                    'https://i.pinimg.com/736x/6a/25/be/6a25be4ce4fcdb7fe95026d08320a1f9.jpg',
                    'https://i.pinimg.com/736x/5d/3a/04/5d3a045151d99adf6178818e901438dd.jpg',
                    'https://i.pinimg.com/736x/93/9a/16/939a16423a9e8471cba19be89ca3b6e9.jpg',
                    'https://i.pinimg.com/736x/c4/1e/5c/c41e5cd1833a6e6c639c18ccd669e910.jpg',
                    'https://i.pinimg.com/736x/01/ed/36/01ed36acb4e9b044a62a821d1139d3c.jpg',
                    'https://i.pinimg.com/736x/9e/88/b4/9e88b42cd11456e338e968e3d357bcf6.jpg',
                    'https://i.pinimg.com/736x/07/10/92/071092e976996fdf9b156343105ec8f2.jpg',
                ],
                'packages' => [
                    [
                        'name' => '4-Island Full Day Speedboat',
                        'description' => <<<'HTML'
                            <div class="space-y-4">
                                <p>Discover the crown jewels of the Trang Archipelago on a <strong>4-Island Full Day Speedboat</strong> tour from Koh Lanta. Swim through the dark 80-meter tunnel of Emerald Cave (Tham Morakot) into a hidden secret beach lagoon, snorkel over pristine coral gardens, and relax on powdery beaches.</p>
                                <img src="https://i.pinimg.com/736x/35/d9/6a/35d96aae8437565d8842eb21867165a5.jpg" alt="Emerald Cave Tham Morakot Koh Mook hidden lagoon" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">What to expect</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Round-trip hotel transfers across Koh Lanta in shared open-air songthaew trucks</li>
                                    <li>Fast speedboat island-hopping to Koh Mook, Koh Kradan, Koh Chuek, and Koh Ngai</li>
                                    <li>Guided group swim through Emerald Cave on Koh Mook into a enclosed rainforest sinkhole lagoon</li>
                                    <li>Two dedicated 45-minute snorkelling stops over vibrant coral reefs teeming with clownfish and sea turtles</li>
                                    <li>Delicious beachside Thai lunch buffet served on the powdery sands of Koh Kradan</li>
                                    <li>Snorkelling mask, snorkel tube, life jacket, drinking water, and seasonal fruit included</li>
                                </ul>
                                <h4 class="text-base font-semibold">Highlights</h4>
                                <ol class="list-decimal pl-5 space-y-1">
                                    <li>Floating through the dark sea cave tunnel into the sunlit secret emerald green beach hidden inside Koh Mook</li>
                                    <li>Sunbathing on Koh Kradan, frequently named among the world's top 5 best beaches</li>
                                    <li>Snorkelling past steep underwater drop-offs at Koh Chuek with schools of colorful sergeant major fish</li>
                                    <li>Cruising past dramatic karst rock arches rising vertically out of crystal-clear Andaman waters</li>
                                </ol>
                                <img src="https://i.pinimg.com/736x/51/78/71/517871a30cdf85ceb0f32211d8a337b5.jpg" alt="Koh Kradan white sand beach turquoise sea" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">Good to know</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Swimming into Emerald Cave requires wearing a life jacket in single-file led by your guide carrying a headlamp flashlight</li>
                                    <li>Use reef-safe coral-friendly sunscreen to protect fragile anemones and brain coral colonies</li>
                                    <li>Tour operates between October and May when sea conditions are calmest</li>
                                </ul>
                                <p><em>Keep your eyes open during the speedboat ride — dolphins are frequently spotted leaping alongside the boat!</em></p>
                            </div>
                            HTML,
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 2500.00],
                            ['age_group_id' => 2, 'price' => 1750.00],
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
                'start_date' => '2026-05-05',
                'end_date' => '2028-05-05',
                'closing_type' => null,
                'closing_days' => [],
                'countries' => [165],
                'cities' => [7024],
                'categories' => [1],
                'images' => [
                    'https://i.pinimg.com/736x/e2/46/3d/e2463d13f36d32ecae1fcaa3e77b220f.jpg',
                    'https://i.pinimg.com/736x/10/45/22/104522e091e22eadc9e27768c42bd6f2.jpg',
                    'https://i.pinimg.com/736x/74/e7/38/74e7388a0df1ab4ff693cbc09192d093.jpg',
                    'https://i.pinimg.com/736x/b5/33/21/b533218cc9a730f255a7285fbfc69788.jpg',
                    'https://i.pinimg.com/736x/2a/48/15/2a4815fcd9185b07ae74fe111f85b4c0.jpg',
                    'https://i.pinimg.com/736x/06/1d/7d/061d7de82d6391ba249c11aca5a040c3.jpg',
                    'https://i.pinimg.com/736x/df/3f/70/df3f70e134dd86c9938084663c9aa59a.jpg',
                    'https://i.pinimg.com/736x/a2/21/77/a22177fac82748f47e9d21521dfc8e0e.jpg',
                    'https://i.pinimg.com/736x/e1/44/48/e1444801081376374f750906e0a9444c.jpg',
                    'https://i.pinimg.com/736x/08/bd/2a/08bd2a21f0f9a6ed9efdcd58230c537f.jpg',
                ],
                'packages' => [
                    [
                        'name' => '2D1N Snorkelling Liveaboard',
                        'description' => <<<'HTML'
                            <div class="space-y-4">
                                <p>Embark on the ultimate marine adventure with a <strong>2D1N Snorkelling Liveaboard</strong> in the world-famous Similan Islands Marine National Park. Sleep aboard a comfortable vessel anchored in turquoise bays, enjoy 6 guided snorkelling sessions with underwater visibility up to 30 meters, and witness incredible sunsets over uninhabited islands.</p>
                                <img src="https://i.pinimg.com/736x/e2/46/3d/e2463d13f36d32ecae1fcaa3e77b220f.jpg" alt="Similan Islands Donald Duck Bay Sailing Rock" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">What to expect</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Overnight air-conditioned cabin stay aboard a spacious liveaboard cruiser</li>
                                    <li>6 comprehensive snorkelling excursions covering Islands No. 4, 7, 8, and 9 (Donald Duck Bay, Christmas Point)</li>
                                    <li>All 5 meals prepared fresh on board (2 lunches, 1 dinner, 1 breakfast, afternoon snacks)</li>
                                    <li>Land excursions to climb iconic Sailing Rock viewpoint and explore pristine powdery white sand beaches</li>
                                    <li>Premium snorkelling mask, fins, wetsuit vest, life jacket, and national park marine permit fees included</li>
                                    <li>Round-trip VIP minivan transfers from Phuket or Khao Lak hotels to Tap Lamu Pier</li>
                                </ul>
                                <h4 class="text-base font-semibold">Highlights</h4>
                                <ol class="list-decimal pl-5 space-y-1">
                                    <li>Swimming with wild green sea turtles and harmless leopard sharks in crystal-clear 30m visibility water</li>
                                    <li>Climbing to the summit of Sailing Rock on Island No. 8 for the world-renowned postcard panorama</li>
                                    <li>Experiencing twilight and sunrise snorkelling sessions before daytime day-tripper boats arrive</li>
                                    <li>Stargazing under an unpolluted night sky from the top sun deck of the liveaboard ship</li>
                                </ol>
                                <img src="https://i.pinimg.com/736x/10/45/22/104522e091e22eadc9e27768c42bd6f2.jpg" alt="Underwater snorkelling sea turtle Similan Islands" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">Good to know</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Similan Islands Marine Park is strictly open only from October 15 to May 15 annually</li>
                                    <li>Single-use plastic bags and non-reef-safe sunscreen are strictly prohibited inside the national park</li>
                                    <li>Seasickness medication is available free of charge on board for the initial open sea crossing</li>
                                </ul>
                                <p><em>Early morning snorkelling at 07:00 AM offers your highest chance of swimming alongside feeding sea turtles in peace.</em></p>
                            </div>
                            HTML,
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 6300.00],
                            ['age_group_id' => 2, 'price' => 4500.00],
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
                'start_date' => '2026-05-05',
                'end_date' => '2028-05-05',
                'closing_type' => null,
                'closing_days' => [],
                'countries' => [165],
                'cities' => [601],
                'categories' => [1],
                'images' => [
                    'https://i.pinimg.com/736x/72/64/11/726411d7fec7ff72339910c026951c91.jpg',
                    'https://i.pinimg.com/736x/b5/80/ec/b580ecc4d70e919bff93ec044a735ed0.jpg',
                    'https://i.pinimg.com/736x/c1/26/c9/c126c9a025a7d9cc4fb245ebbeda314b.jpg',
                    'https://i.pinimg.com/736x/36/21/08/36210808df9a194d39bd1dfbe3f13976.jpg',
                    'https://i.pinimg.com/736x/bb/99/55/bb9955a7d863f074d64bd6addbf89454.jpg',
                    'https://i.pinimg.com/736x/5b/35/e7/5b35e7ff5bcae85220ebb910d7a198e6.jpg',
                    'https://i.pinimg.com/736x/14/4b/5f/144b5f78bbda0a5856baa07e043c0091.jpg',
                    'https://i.pinimg.com/736x/28/7a/b4/287ab43493488f6e65bf446cbb0cb7d4.jpg',
                    'https://i.pinimg.com/736x/b6/67/a2/b667a2348550076546fe1c741c55dde5.jpg',
                    'https://i.pinimg.com/736x/a7/62/4b/a7624ba281434b98107fb14692b9adf2.jpg',
                ],
                'packages' => [
                    [
                        'name' => 'Doi Suthep Half Day Tour',
                        'description' => <<<'HTML'
                            <div class="space-y-4">
                                <p>Ascend the sacred mountain overlooking Chiang Mai on a <strong>Doi Suthep Half Day Tour</strong>. Visit Wat Phra That Doi Suthep, the spiritual heart of Northern Thailand featuring a gleaming 24-karat gold-plated stupa, then continue higher up the mountain trail to visit a traditional Khun Chang Kian Hmong hill tribe village.</p>
                                <img src="https://i.pinimg.com/736x/72/64/11/726411d7fec7ff72339910c026951c91.jpg" alt="Golden Chedi Stupa Wat Phra That Doi Suthep" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">What to expect</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Round-trip hotel transport in shared songthaew or air-conditioned minivan up the winding mountain road</li>
                                    <li>Guided tour of Wat Phra That Doi Suthep including the option for cable car elevator or the 309-step Naga staircase</li>
                                    <li>Entrance tickets, temple permits, and expert English-speaking cultural guide</li>
                                    <li>Guided walk through a Hmong ethnic minority village to learn about traditional textiles and mountain life</li>
                                    <li>Panoramic viewpoint overlooking the entire grid valley of Chiang Mai city</li>
                                </ul>
                                <h4 class="text-base font-semibold">Highlights</h4>
                                <ol class="list-decimal pl-5 space-y-1">
                                    <li>Walking clockwise around the radiant golden central stupa housing holy Buddha relics</li>
                                    <li>Climbing the impressive 309-step brick staircase flanked by giant ornate green Naga sea serpents</li>
                                    <li>Ringing ancient brass temple bells surrounding the shrine courtyard for good fortune</li>
                                    <li>Browsing handcrafted embroidery and sampling local coffee roasted by Hmong hill tribe farmers</li>
                                </ol>
                                <img src="https://i.pinimg.com/736x/b5/80/ec/b580ecc4d70e919bff93ec044a735ed0.jpg" alt="309 step Naga Serpent staircase Doi Suthep" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">Good to know</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Strict temple dress code: shoulders and knees must be fully covered (no tank tops or short shorts)</li>
                                    <li>Shoes must be removed before entering the inner marble courtyard around the golden chedi</li>
                                    <li>The mountain road has many sharp hairpin bends — take motion sickness precautions if prone to car sickness</li>
                                </ul>
                                <p><em>Visit during late afternoon to hear the monks chanting evening prayers as golden twilight illuminates the stupa.</em></p>
                            </div>
                            HTML,
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 1050.00],
                            ['age_group_id' => 2, 'price' => 650.00],
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
                'start_date' => '2026-05-05',
                'end_date' => '2028-05-05',
                'closing_type' => null,
                'closing_days' => [],
                'countries' => [165],
                'cities' => [17],
                'categories' => [1],
                'images' => [
                    'https://i.pinimg.com/736x/b6/c0/65/b6c065559e1be55633b23771a54f4fd8.jpg',
                    'https://i.pinimg.com/736x/2b/6a/45/2b6a4582b5b03f736891a962f6a15206.jpg',
                    'https://i.pinimg.com/736x/b8/be/c0/b8bec0d7e09ca84e3a9ed9314ce743b8.jpg',
                    'https://i.pinimg.com/736x/e6/29/60/e62960826841ae0bb16da336e7f98772.jpg',
                    'https://i.pinimg.com/736x/84/9f/a2/849fa20c8926f1d3a742389fbb2b457e.jpg',
                    'https://i.pinimg.com/736x/da/6b/c2/da6bc21c4396329fdf594d72e498ce0a.jpg',
                    'https://i.pinimg.com/736x/e3/4a/c8/e34ac83c5f8b35750411a65bdd79ce3e.jpg',
                    'https://i.pinimg.com/736x/c9/fb/cd/c9fbcdeab1125d2d6c973952f49d2c58.jpg',
                    'https://i.pinimg.com/736x/74/0e/3e/740e3eaeea2dc489e31afb6a1357f91e.jpg',
                    'https://i.pinimg.com/736x/ac/9f/fb/ac9ffb7ce2fc600733605e2e6f1787c5.jpg',
                ],
                'packages' => [
                    [
                        'name' => 'Full Day Khao Yai Safari',
                        'description' => <<<'HTML'
                            <div class="space-y-4">
                                <p>Embark on an wilderness adventure with a <strong>Full Day Khao Yai Safari</strong> in Thailand's oldest national park and UNESCO World Heritage forest. Explore dense jungle trails in an open-top 4x4 safari truck, search for wild Asian elephants, spot exotic Great Hornbills, and stand beside roaring tropical waterfalls.</p>
                                <img src="https://i.pinimg.com/736x/b6/c0/65/b6c065559e1be55633b23771a54f4fd8.jpg" alt="Khao Yai National Park wild elephant safari" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">What to expect</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Round-trip transport from Bangkok or Pak Chong in comfortable air-conditioned vehicles</li>
                                    <li>Open-sided 4x4 safari truck game drive guided by a specialist wildlife spotter ranger</li>
                                    <li>2-hour guided jungle nature walk along KM 33 trail watching for white-handed gibbons and macaques</li>
                                    <li>Visit to Haew Suwat Waterfall (famously featured in Leonardo DiCaprio's movie <em>The Beach</em>)</li>
                                    <li>Visit to Haew Narok 3-tier giant waterfall viewpoint</li>
                                    <li>Thai lunch buffet, national park entry fees, and leech socks provided during rainy season</li>
                                </ul>
                                <h4 class="text-base font-semibold">Highlights</h4>
                                <ol class="list-decimal pl-5 space-y-1">
                                    <li>Spotting wild Asian elephant herds grazing near natural salt licks during afternoon game drives</li>
                                    <li>Listening to the melodious morning calls of wild gibbons echoing through the dense jungle canopy</li>
                                    <li>Watching massive Great Hornbill birds flying across the mountain valleys with 1.5m wingspans</li>
                                    <li>Standing at the precipice of Haew Suwat Waterfall cascading 20 meters into a jungle pool</li>
                                </ol>
                                <img src="https://i.pinimg.com/736x/2b/6a/45/2b6a4582b5b03f736891a962f6a15206.jpg" alt="Haew Suwat Waterfall Khao Yai" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">Good to know</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Leech socks are provided by your guide during wet monsoon months (July to October) — wear closed hiking shoes</li>
                                    <li>Wild elephant sightings are natural and unscripted; maintain quiet discipline when spotters stop the vehicle</li>
                                    <li>Binoculars and rain ponchos are recommended additions to your daypack</li>
                                </ul>
                                <p><em>Extend your visit with an evening night spot-lighting safari to see porcupines, civets, and nocturnal deer.</em></p>
                            </div>
                            HTML,
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 3000.00],
                            ['age_group_id' => 2, 'price' => 2100.00],
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
                'start_date' => '2026-05-05',
                'end_date' => '2028-05-05',
                'closing_type' => null,
                'closing_days' => [],
                'countries' => [165],
                'cities' => [8320],
                'categories' => [1],
                'images' => [
                    'https://i.pinimg.com/736x/8f/4f/5a/8f4f5a524142235ad8969f29b3df0f6a.jpg',
                    'https://i.pinimg.com/736x/cc/17/3e/cc173e6842c64c40361e9e5943fb95cd.jpg',
                    'https://i.pinimg.com/736x/ba/3c/08/ba3c084260161b1b7aebe8ec5741e7e6.jpg',
                    'https://i.pinimg.com/736x/49/5a/47/495a47e5878a480ae05431706d128e33.jpg',
                    'https://i.pinimg.com/736x/dc/f7/a6/dcf7a6e38ab2df2066fabdb5d4bf712a.jpg',
                ],
                'packages' => [
                    [
                        'name' => 'Hua Hin Day Trip',
                        'description' => <<<'HTML'
                            <div class="space-y-4">
                                <p>Escape to the historic royal seaside retreat with a <strong>Hua Hin Day Trip</strong>. Enjoy a relaxing day strolling along Hua Hin's wide 5-kilometer white sand beach, admire Victorian-Thai wooden architecture at the historic Hua Hin Railway Station, and spend the evening at the famous Cicada Outdoor Art & Food Market.</p>
                                <img src="https://i.pinimg.com/736x/8f/4f/5a/8f4f5a524142235ad8969f29b3df0f6a.jpg" alt="Hua Hin Beach long white sand shoreline" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">What to expect</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Private round-trip air-conditioned transfer from Bangkok to Hua Hin (approx. 2.5 hours)</li>
                                    <li>Free afternoon time on Hua Hin main beach for horseback riding, sunbathing, or seafood dining</li>
                                    <li>Photo visit to the historic 1920s royal red-and-gold wooden Hua Hin Railway Station pavilion</li>
                                    <li>Panoramic coastal photo stop at Khao Takiab (Monkey Mountain) temple hill</li>
                                    <li>2 hours of evening free time to explore Cicada Market and Tamarind Market</li>
                                </ul>
                                <h4 class="text-base font-semibold">Highlights</h4>
                                <ol class="list-decimal pl-5 space-y-1">
                                    <li>Riding horses along the smooth water edge of Hua Hin Beach at sunset</li>
                                    <li>Exploring Cicada Market's open-air art gallery featuring hand-painted canvases, sculptures, and live theater</li>
                                    <li>Sampling gourmet seafood, artisan pastries, and craft beverages at clean garden food pavilions</li>
                                    <li>Posing at the historic Royal Waiting Room at iconic Hua Hin Railway Station</li>
                                </ol>
                                <img src="https://i.pinimg.com/736x/cc/17/3e/cc173e6842c64c40361e9e5943fb95cd.jpg" alt="Cicada Night Market Hua Hin art and food" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">Good to know</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Cicada Market operates exclusively on weekend evenings (Friday, Saturday, and Sunday from 16:00 to 23:00)</li>
                                    <li>Khao Takiab hill is home to wild macaques — keep food items inside your bags when walking near temple stairs</li>
                                    <li>Cicada Market uses a coupon card system for food purchases — purchase food coupons at entrance booths</li>
                                </ul>
                                <p><em>Visit Tamarind Market located right next door to Cicada for fantastic live acoustic bands and cheaper food stalls!</em></p>
                            </div>
                            HTML,
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 1500.00],
                            ['age_group_id' => 2, 'price' => 900.00],
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
                'start_date' => '2026-05-05',
                'end_date' => '2028-05-05',
                'closing_type' => null,
                'closing_days' => [],
                'countries' => [165],
                'cities' => [601],
                'categories' => [1],
                'images' => [
                    'https://i.pinimg.com/736x/90/6c/8e/906c8e9e31bf7647e08257030e2dbb09.jpg',
                    'https://i.pinimg.com/736x/da/8b/42/da8b4279750cd9f2177ad680b68614d3.jpg',
                    'https://i.pinimg.com/736x/ac/59/f7/ac59f7ae863fbb91dcd53d528e68c96d.jpg',
                    'https://i.pinimg.com/736x/e0/9f/84/e09f8431adddc8b40260f05acaafe9c0.jpg',
                    'https://i.pinimg.com/736x/64/5a/3e/645a3eacbde35972248d20494c3d654c.jpg',
                    'https://i.pinimg.com/736x/67/40/6e/67406e37a38fa2ce3b32fd6b8b70726f.jpg',
                    'https://i.pinimg.com/736x/3f/1d/27/3f1d27a65b8a509449d93432065b0d56.jpg',
                    'https://i.pinimg.com/736x/e3/43/3e/e3433e5655eea1e617d5eaafd3e01d21.jpg',
                    'https://i.pinimg.com/736x/8b/16/36/8b1636b1e2b60ab0867c9cd9d1977fc5.jpg',
                    'https://i.pinimg.com/736x/f0/ff/c1/f0ffc1ddd56e3be7daeffcc066050072.jpg',
                ],
                'packages' => [
                    [
                        'name' => '2D1N Pai Adventure Tour',
                        'description' => <<<'HTML'
                            <div class="space-y-4">
                                <p>Journey through 762 mountain turns into Northern Thailand's bohemian valley with a <strong>2D1N Pai Adventure Tour</strong>. Trek the dramatic narrow clay ridges of Pai Canyon at sunset, soak in natural jungle thermal hot springs, visit Tham Lod bamboo raft cave, and experience Pai's cozy night walking street.</p>
                                <img src="https://i.pinimg.com/736x/90/6c/8e/906c8e9e31bf7647e08257030e2dbb09.jpg" alt="Pai Canyon Kong Lan sunset narrow ridges" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">What to expect</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Round-trip minivan transport through scenic mountain highways from Chiang Mai</li>
                                    <li>Overnight stay in a comfortable boutique Pai valley resort with breakfast</li>
                                    <li>Guided sunset trek along the eroded red clay ridges of Pai Canyon (Kong Lan)</li>
                                    <li>Soaking session in mineral-rich natural thermal pools at Sai Ngam or Tha Pai Hot Springs</li>
                                    <li>Bamboo raft floating tour inside massive Tham Lod cave guided by lantern-bearing locals</li>
                                    <li>Visits to Pai Memorial WWII Bridge, Santichon Chinese Yunnan Village, and Wat Phra That Mae Yen hill giant white Buddha</li>
                                </ul>
                                <h4 class="text-base font-semibold">Highlights</h4>
                                <ol class="list-decimal pl-5 space-y-1">
                                    <li>Walking narrow cliff-side ridge paths at Pai Canyon with spectacular 360-degree mountain valley sunset views</li>
                                    <li>Floating on a silent bamboo raft inside Tham Lod cave while thousands of swifts return to cave ceilings at dusk</li>
                                    <li>Soaking in 38°C crystal-clear natural thermal forest pools at Sai Ngam Secret Hot Springs</li>
                                    <li>Browsing herbal teas, handmade jewelry, and international street food along Pai Walking Street at night</li>
                                </ol>
                                <img src="https://i.pinimg.com/736x/da/8b/42/da8b4279750cd9f2177ad680b68614d3.jpg" alt="Sai Ngam natural hot springs Pai" class="w-full rounded-lg" />
                                <h4 class="text-base font-semibold">Good to know</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Pai Canyon ridges have steep drop-offs on both sides without guardrails — wear sturdy grip sneakers and exercise caution</li>
                                    <li>The drive from Chiang Mai to Pai features 762 curve turns; motion sickness tablets are strongly recommended</li>
                                    <li>Cool mountain temperatures occur from November to February (down to 10°C at night) — pack warm layers</li>
                                </ul>
                                <p><em>Climb the 353 stairs up to Wat Phra That Mae Yen White Buddha early in the morning for misty valley views.</em></p>
                            </div>
                            HTML,
                        'prices' => [
                            ['age_group_id' => 1, 'price' => 3200.00],
                            ['age_group_id' => 2, 'price' => 2300.00],
                        ],
                    ],
                ],
            ],
        ];

        /** @var array<int, int> $supplierIds */
        $supplierIds = Supplier::pluck('id')->all();

        foreach ($products as $data) {
            $lowestPackagePrice = collect($data['packages'])
                ->flatMap(fn (array $package): array => $package['prices'])
                ->min('price');

            $product = Product::create([
                'supplier_id' => $supplierIds ? Arr::random($supplierIds) : null,
                'name' => $data['name'],
                'service' => ServiceEnum::ATTRACTION->value,
                'star_rating' => $data['star_rating'],
                'price' => $lowestPackagePrice,
                'is_active' => true,
            ]);

            $noSpaceName = str_replace(' ', '', strtolower($product->name));
            $product->update([
                'slug' => $product->id.'-'.Str::slug($product->name),
                'search_keywords' => "{$noSpaceName}, ".$data['search_keywords'],
            ]);

            // Format highlights to high-quality, long-sentence bullet points
            $rawHighlights = array_filter(array_map('trim', explode(',', $data['highlights'])));
            $rawHighlights = array_values($rawHighlights);

            $formattedHighlights = [];

            // Bullet 1: Exclusivity & seamless entry
            $formattedHighlights[] = 'Exclusivity and convenience with seamless entry tickets to explore '.$data['name'].' for a completely hassle-free visit.';

            // Bullet 2: Core expectation
            $coreExpect = trim($data['what_to_expect']);
            $coreExpect = rtrim($coreExpect, '.');
            if (strncasecmp($coreExpect, 'experience', 10) === 0) {
                $formattedHighlights[] = $coreExpect.' in a highly immersive and beautifully themed environment.';
            } else {
                $formattedHighlights[] = 'Experience the best of the venue: '.lcfirst($coreExpect).' for an unforgettable day.';
            }

            // Bullet 3: Highlight 1 & 2
            if (isset($rawHighlights[0])) {
                $extra = isset($rawHighlights[1]) ? ' and the iconic '.$rawHighlights[1] : '';
                $formattedHighlights[] = 'Discover the spectacular landmarks and popular attractions of the venue, including '.$rawHighlights[0].$extra.' for visitors of all ages.';
            } else {
                $formattedHighlights[] = 'Marvel at the stunning architectural layouts and scenic backdrops that make this destination a world-renowned highlight.';
            }

            // Bullet 4: Highlight 3 & 4 / Good to know
            if (isset($rawHighlights[2])) {
                $extra = isset($rawHighlights[3]) ? ' as well as '.$rawHighlights[3] : '';
                $formattedHighlights[] = 'Hop on thrilling rides, explore detailed themed zones, or check out unique highlights like '.$rawHighlights[2].$extra.'.';
            } else {
                $goodToKnow = trim($data['good_to_know']);
                $goodToKnow = rtrim($goodToKnow, '.');
                $formattedHighlights[] = 'Get the most out of your trip with helpful tips: '.lcfirst($goodToKnow).' to ensure a highly comfortable and safe experience.';
            }

            // Bullet 5: Timing / memorable sunset or night view
            $formattedHighlights[] = 'Visit in the late afternoon for a memorable sunset experience or early in the morning for a relaxed, crowd-free exploration of '.$data['name'].'.';

            $img1 = $data['images'][0] ?? '';
            $img2 = $data['images'][1] ?? $img1;
            $img3 = $data['images'][2] ?? $img1;
            $img4 = $data['images'][3] ?? $img2;

            $whatToExpectHtml = '<div class="space-y-4">'
                .'<p>Step into an unforgettable experience at <strong>'.e($data['name']).'</strong>. '.e($data['what_to_expect']).'</p>'
                .($img1 ? '<img src="'.e($img1).'" alt="'.e($data['name']).' experience" class="w-full rounded-lg" />' : '')
                .'<h4 class="text-base font-semibold">What You Will Experience</h4>'
                .'<ul class="list-disc pl-5 space-y-2">'
                .'<li><strong>World-Class Attraction:</strong> Discover iconic sights and themed zones designed for visitors of all ages.</li>'
                .'<li><strong>Immersive Environment:</strong> Enjoy state-of-the-art facilities, breathtaking architecture, and scenic natural backdrops.</li>'
                .'<li><strong>Memorable Entertainment:</strong> Access curated rides, live performances, cultural exhibits, and engaging activities throughout your visit.</li>'
                .'<li><strong>Convenient Facilities:</strong> On-site dining outlets, resting zones, locker rentals, and guest assistance desks ensure a comfortable day out.</li>'
                .'</ul>'
                .($img2 ? '<img src="'.e($img2).'" alt="'.e($data['name']).' view" class="w-full rounded-lg" />' : '')
                .'<p><em>Plan your visit early in the day or during sunset hours to capture the best atmospheric views and avoid peak crowd waiting times.</em></p>'
                .'</div>';

            $goodToKnowHtml = '<div class="space-y-4">'
                .'<p>Essential visitor information, dress codes, entry policies, and practical travel advice for visiting <strong>'.e($data['name']).'</strong>.</p>'
                .'<h4 class="text-base font-semibold">Important Visitor Guidelines</h4>'
                .'<ul class="list-disc pl-5 space-y-2">'
                .'<li><strong>Visitor Advice:</strong> '.e($data['good_to_know']).'</li>'
                .'<li><strong>Arrival & Entry:</strong> Arrive 20–30 minutes before your scheduled entry time. Scan your mobile e-voucher directly at turnstiles or ticket windows for fast access.</li>'
                .'<li><strong>Dress Code & Footwear:</strong> Wear comfortable walking shoes or water sandals suitable for the venue. Respectful attire (covered shoulders and knees) is required at temple and sacred sites.</li>'
                .'<li><strong>Photography & Gear:</strong> Personal photography is welcome in public areas. Flash photography, drones, and large tripods are prohibited inside indoor exhibit halls.</li>'
                .'<li><strong>Safety & Accessibility:</strong> Height, age, and physical condition restrictions apply to select rides or water activities. Please check safety notices at entrances.</li>'
                .'</ul>'
                .($img3 ? '<img src="'.e($img3).'" alt="'.e($data['name']).' visitor guide" class="w-full rounded-lg" />' : '')
                .'<p><em>Always carry a valid photo ID matching your booking confirmation details and check local weather forecasts prior to departure.</em></p>'
                .'</div>';

            $highlightsHtml = '<div class="space-y-4">'
                .'<p>Discover the top rated features and unmissable key attractions at <strong>'.e($data['name']).'</strong>:</p>'
                .($img4 ? '<img src="'.e($img4).'" alt="'.e($data['name']).' highlights" class="w-full rounded-lg" />' : '')
                .'<h4 class="text-base font-semibold">Key Highlights</h4>'
                .'<ul class="list-disc pl-5 space-y-2">';
            foreach ($formattedHighlights as $item) {
                $highlightsHtml .= '<li>'.e($item).'</li>';
            }
            $highlightsHtml .= '</ul>'
                .'<p><em>Discover why '.e($data['name']).' is rated as one of the top recommended destinations in the region!</em></p>'
                .'</div>';

            $product->detail()->create([
                'what_to_expect' => $whatToExpectHtml,
                'good_to_know' => $goodToKnowHtml,
                'highlights' => $highlightsHtml,
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
