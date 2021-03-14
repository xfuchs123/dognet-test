<?php

use common\models\User;
use yii\db\Migration;

/**
 * Class m210312_173607_add_user_data
 */
class m210312_173607_add_user_data extends Migration
{
    /**
     * {@inheritdoc}
     * @throws Throwable
     */
    public function safeUp()
    {
            $userNamesAndEmails = [
                ['Ondrej', 'ondrej@test.com'],
                ['Peter', 'peter@test.com'],
                ['Slavo', 'slavo@test.com']
            ];

            for ($i = 0; $i < 3; $i++) {
                $user = new User();
                $user->setPassword('tester');
                $user->username = $userNamesAndEmails[$i][0];
                $user->email = $userNamesAndEmails[$i][1];
                $user->generateAuthKey();
                if (!$user->insert(false)) {
                    return false;
                }
            }

            return true;
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210312_173607_add_user_data cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210312_173607_add_user_data cannot be reverted.\n";

        return false;
    }
    */
}
