<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Status;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 'name'
     * 'description'
     * 'image'
     */
    public function run(): void
    {
        $faker = Faker::create();
        $statuses = ['Available', 'Not available', 'Temporarily', 'Reducer', 'Currently unavailable'];
        // $description = ['يكون المنتج متاحًا للشراء ويعرض كمنتج قابل للشراء بوضوح في صفحات المتجر. يتم عرض جميع التفاصيل اللازمة للمنتج مثل الصورة، السعر، الوصف، والخصائص الفنية.', 'قد يكون هناك حالات عندما يكون المنتج غير متاح للشراء. يتم عرض المنتج بشكل غير قابل للشراء وقد يتم عرض رسالة توضح سبب عدم التوفر مثل "غير متاح حاليًا" أو "نفدت الكمية".', 'يمكن أن يكون هناك حالات عندما يتم توفير المنتج بشكل مؤقت أو بشكل خاص. قد يتم تعيين مدة زمنية محددة لتوفر المنتج أو يكون متاحًا لمجموعة محدودة من العملاء (على سبيل المثال، الأعضاء المميزين).', 'في بعض الأحيان يتم تخفيض سعر المنتج مؤقتًا بسبب تخفيضات أو عروض خاصة. يتم عرض السعر الأصلي والسعر المخفض بوضوح.', 'قد يتم تعيين بعض المنتجات كغير متاحة حاليًا وتوضع في قائمة انتظار أو قائمة انتظار مسبق. يتم عرض معلومات الاتصال للمستخدمين الذين يرغبون في معرفة متى يتوفر المنتج مرة أخرى.'];
        foreach ($statuses as $key => $status) {
            $user = DB::table('users')->find(1);

            Status::create([
                'name' => $status,
                // 'description' => $description,
                'image' => $faker->imageUrl,
                'user_id' => $user->id,
            ]);
        }
    }
}
