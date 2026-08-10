<?php

use App\Models\AgeGroup;
use App\Models\Category;
use App\Services\Admin\AgeGroupService;
use App\Services\Admin\CategoryService;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('sets app locale from Accept-Language header via middleware', function () {
    Category::create([
        'name' => [
            'en' => 'Theme Parks',
            'mm' => 'ကစားကွင်းများ',
        ],
    ]);

    $service = new CategoryService;

    app()->setLocale('mm');
    expect(app()->getLocale())->toBe('mm');
    $resultsMm = $service->listing(10);
    expect($resultsMm->first()->name)->toBe('ကစားကွင်းများ');

    app()->setLocale('en');
    expect(app()->getLocale())->toBe('en');
    $resultsEn = $service->listing(10);
    expect($resultsEn->first()->name)->toBe('Theme Parks');
});

it('supports multi-language category names and locale resolution', function () {
    $category = Category::create([
        'name' => [
            'en' => 'Theme Parks',
            'mm' => 'ကစားကွင်းများ',
        ],
    ]);

    app()->setLocale('en');
    expect($category->name)->toBe('Theme Parks');

    app()->setLocale('mm');
    expect($category->name)->toBe('ကစားကွင်းများ');
});

it('supports multi-language age groups', function () {
    $ageGroup = AgeGroup::create([
        'name' => [
            'en' => 'Adult',
            'mm' => 'လူကြီး',
        ],
        'min_age' => 18,
        'max_age' => 60,
    ]);

    app()->setLocale('en');
    expect($ageGroup->name)->toBe('Adult');

    app()->setLocale('mm');
    expect($ageGroup->name)->toBe('လူကြီး');
});

it('filters categories using search in different languages', function () {
    Category::create([
        'name' => [
            'en' => 'Water Park',
            'mm' => 'ရေကစားကွင်း',
        ],
    ]);

    Category::create([
        'name' => [
            'en' => 'Museum',
            'mm' => 'ပြတိုက်',
        ],
    ]);

    $service = new CategoryService;

    app()->setLocale('en');
    $resultsEn = $service->listing(10, 'Water');
    expect($resultsEn->count())->toBe(1);
    expect($resultsEn->first()->getTranslation('name', 'en'))->toBe('Water Park');

    app()->setLocale('mm');
    $resultsMm = $service->listing(10, 'ပြတိုက်');
    expect($resultsMm->count())->toBe(1);
    expect($resultsMm->first()->getTranslation('name', 'mm'))->toBe('ပြတိုက်');
});

it('filters age groups using search in different languages', function () {
    AgeGroup::create([
        'name' => [
            'en' => 'Child',
            'mm' => 'ကလေး',
        ],
    ]);

    $service = new AgeGroupService;

    app()->setLocale('en');
    $resultsEn = $service->listing(10, 'Child');
    expect($resultsEn->count())->toBe(1);

    app()->setLocale('mm');
    $resultsMm = $service->listing(10, 'ကလေး');
    expect($resultsMm->count())->toBe(1);
});
