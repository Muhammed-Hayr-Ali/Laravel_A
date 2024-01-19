<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *    'name',
     *    'email',
     *    'status',
     *    'country_code',
     *    'phone_number',
     *    'gender',
     *    'date_birth',
     *    'profile',
     *    'password',
     *    'permissions',
     *    'expiration_date',
     *    'email_verified_at',
     *    'default_address',
     */
    public function run(): void
    {
        $faker = Faker::create();
        $password = Hash::make('Aa99009900');

        $statusList = [
            'اللهم إني استودعتك كافة الأمور فوفقني وبارك لي في وقتي، وأتمم علي نعمتك وجودك وكرمك.',
            'اللهم برحمتك الواسعة التي وسعت كل شيء، ارحمني في الأرض ويوم العرض.',
            'اللهم بغيبك وبعلمك الذي لا يستطيع أحد أن يأتي به، فاجعل لي القدر الجميل من كل شيء.',
            'أصبحنا وأصبح الملك لله والحمد لله ولا إله ألا الله والله أكبر، اللهم إني أصبحت على نعمتك ورحمتك وجودك وكرمك، فسخر لي ما تحب وترضى.',
            'اللهم إني أسألك بكل اسم هو لك سميت به نفسك، أن تجعل القرآن الكريم غفرانًا لي يوم القيامة، وشفاء لروحي وصدري.',
            'اللهم في هذا الصباح أسألك علمًا نافعًا، وعملاً متقبلاً، وأسألك اللهم كل الخير الذي عندك، وأعوذ بك من كل شر في هذه الدنيا.',
            'اللهم إني أسألك التمام في الدنيا والآخرة، فأعني يا كريم ولا تعِن علي إنك أنت أكرم الأكرمين.',
            'اللهم امنحني الراحة والطمأنينة في قلبي وجعلني من أسعد العباد.',
            'اللهم عافني واعفُ عني واجعلني من أهلك وخاصتك وارزقني كل الخير الذي عندك في الحياة وبعد الممات.',
            'اللهم افتح لي كافة المغاليق وهيئ لي كافة الأسباب ونجني من كل كرب وهم وغم.',
            'اللهم ارزقني وأحبتي من رزقك الوفير وبارك لي وتولني فيمن توليت.',
            'اللهم أسعدني وأسعد من أحب بما أتمنى ويتمنون واملأ قلوبنا بالسرور والراحة.',
            'اللهم إنك خير حافظ فاحفظنا واحفظ من نحب.',
            'اللهم كما جمعتني بمن أحب في الدنيا تجمعني بهم يوم القيامة.',
            'اللهم ارزقني صديقًا صالحًا ومحبًا يعينني في أمر ديني ودنياي وأن يصبح همنا مرضاتك والفوز بجنتك التي هي دار المستقر والمتاع.',
            'يقول عمر بن الخطاب -رضي الله عنه-: “إني لأكره لأحدكم أن يكون خاليًا، لا في عمل دنيا ولا دين”.',
            'قال علي بين أبي طالب -رضي الله عنه-: “حسن الخلق في ثلاث خصال: اجتناب المحارم، وطلب الحلال، والتّوسعة على العيال”.',
            'قال عبد الله بن مسعود: “إني لأحسب الرجل ينسى العلم كان يعلمه بالخطيئة يعملها”',
        ];

        User::create([
            'email' => 'm.thelord963@gmail.com',
            'name' => 'Mohammed kher Ali',
            'status' => 'لا يؤخر الله أمراً إلا لخير، ولا يحرمك أمراً إلا لخير، ولا ينزل عليك بلاء إلا لخير',
            'phone_number' => '0992058010',
            'gender' => 'Male',
            'date_birth' => '8/11/1986',
            'profile' => 'https://image.winudf.com/v2/image1/bmV0LndsbHBwci5ib3lzX3Byb2ZpbGVfcGljdHVyZXNfc2NyZWVuXzBfMTY2NzUzNzYxN18wOTk/screen-0.webp?fakeurl=1&type=.webp',
            'password' => $password,
            'role' => 'Administrator',
        ]);
        for ($i = 0; $i < 18; $i++) {
            User::create([
                'email' => $faker->email,
                'name' => $faker->firstName(),
                'status' => $statusList[$i],
                'phone_number' => $faker->phoneNumber(),
                'gender' => $faker->randomElement(['Unspecified', 'Male', 'Female']),
                'date_birth' => $faker->date($format = 'm/d/Y', $max = 'now'),
                'profile' => $faker->imageUrl,
                'password' => $password,
                'role' => 'user',
            ]);
        }
    }
}
