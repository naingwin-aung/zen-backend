<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $convertToJson = function (string $table, array $columns) {
            if (! Schema::hasTable($table)) {
                return;
            }

            $rows = DB::table($table)->get();
            foreach ($rows as $row) {
                $updates = [];
                foreach ($columns as $column) {
                    if (! isset($row->{$column})) {
                        continue;
                    }
                    $val = $row->{$column};
                    if ($val !== null && ! str_starts_with(trim((string) $val), '{')) {
                        $updates[$column] = json_encode(['en' => $val], JSON_UNESCAPED_UNICODE);
                    }
                }
                if (! empty($updates)) {
                    DB::table($table)->where('id', $row->id)->update($updates);
                }
            }
        };

        $convertToJson('age_groups', ['name']);
        $convertToJson('categories', ['name']);
        $convertToJson('attraction_packages', ['name', 'description']);
        $convertToJson('products', ['name']);
        $convertToJson('product_details', ['what_to_expect', 'good_to_know', 'highlights']);

        Schema::table('products', function (Blueprint $table) {
            $table->dropIndex(['name']);
        });

        $driver = DB::getDriverName();

        if ($driver === 'pgsql') {
            DB::statement('ALTER TABLE age_groups ALTER COLUMN name TYPE json USING name::json');
            DB::statement('ALTER TABLE categories ALTER COLUMN name TYPE json USING name::json');
            DB::statement('ALTER TABLE attraction_packages ALTER COLUMN name TYPE json USING name::json');
            DB::statement('ALTER TABLE attraction_packages ALTER COLUMN description TYPE json USING description::json');
            DB::statement('ALTER TABLE products ALTER COLUMN name TYPE json USING name::json');
            DB::statement('ALTER TABLE product_details ALTER COLUMN what_to_expect TYPE json USING what_to_expect::json');
            DB::statement('ALTER TABLE product_details ALTER COLUMN good_to_know TYPE json USING good_to_know::json');
            DB::statement('ALTER TABLE product_details ALTER COLUMN highlights TYPE json USING highlights::json');
        } else {
            Schema::table('age_groups', function (Blueprint $table) {
                $table->json('name')->change();
            });

            Schema::table('categories', function (Blueprint $table) {
                $table->json('name')->nullable()->change();
            });

            Schema::table('attraction_packages', function (Blueprint $table) {
                $table->json('name')->nullable()->change();
                $table->json('description')->nullable()->change();
            });

            Schema::table('products', function (Blueprint $table) {
                $table->json('name')->nullable()->change();
            });

            Schema::table('product_details', function (Blueprint $table) {
                $table->json('what_to_expect')->nullable()->change();
                $table->json('good_to_know')->nullable()->change();
                $table->json('highlights')->nullable()->change();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('age_groups', function (Blueprint $table) {
            $table->string('name')->change();
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->string('name')->nullable()->change();
        });

        Schema::table('attraction_packages', function (Blueprint $table) {
            $table->string('name')->nullable()->change();
            $table->longText('description')->nullable()->change();
        });

        Schema::table('products', function (Blueprint $table) {
            $table->string('name')->nullable()->change();
            $table->index('name');
        });

        Schema::table('product_details', function (Blueprint $table) {
            $table->longText('what_to_expect')->nullable()->change();
            $table->longText('good_to_know')->nullable()->change();
            $table->longText('highlights')->nullable()->change();
        });
    }
};
