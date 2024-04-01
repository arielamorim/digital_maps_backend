<?php

namespace Tests\Unit;

use App\Helper\LocationHelper;
use PHPUnit\Framework\TestCase;

class LocationHelperTest extends TestCase
{

    /**
     * Teste para a função `orderByProximity`.
     *
     * @return void
     */
    public function test_order_by_proximity()
    {
        $reference = ['X' => 5, 'Y' => 10];

        $locations = [
            ['X' => 2, 'Y' => 4, 'id' => 5, 'name'=> 'Loja Magalu', 'opensAt'=> '09:00', 'closesAt' => '21:00'],
            ['X' => 8, 'Y' => 12, 'id' => 8, 'name'=> 'Hamburgueria SevenKings', 'opensAt'=> '11:00', 'closesAt' => '23:00'],
            ['X' => 1, 'Y' => 1, 'id' => 3, 'name'=> 'Nerdbunker', 'opensAt'=> '09:00', 'closesAt' => '18:00'],
            ['X' => 7, 'Y' => 9, 'id' => 6, 'name'=> 'Posto de gasolina', 'opensAt'=> '07:00', 'closesAt' => '23:00'],
        ];

        $expected = [
            ['X' => 7, 'Y' => 9, 'id' => 6, 'name'=> 'Posto de gasolina', 'opensAt'=> '07:00', 'closesAt' => '23:00'],
            ['X' => 2, 'Y' => 4, 'id' => 5, 'name'=> 'Loja Magalu', 'opensAt'=> '09:00', 'closesAt' => '21:00'],
            ['X' => 8, 'Y' => 12,'id' => 8, 'name'=> 'Hamburgueria SevenKings', 'opensAt'=> '11:00', 'closesAt' => '23:00'],
            ['X' => 1, 'Y' => 1,'id' => 3, 'name'=> 'Nerdbunker', 'opensAt'=> '09:00', 'closesAt' => '18:00'],
        ];

        $helper = new LocationHelper();
        $actual = $helper->orderByProximity( $reference, $locations);

        $this->assertEquals($expected, $actual);
    }

    public function test_check_if_location_is_open()
    {
        $locations = [
            ['X' => 2, 'Y' => 4, 'id' => 5, 'name'=> 'Loja Magalu', 'opensAt'=> '09:00', 'closesAt' => '21:00'],
            ['X' => 8, 'Y' => 12, 'id' => 8, 'name'=> 'Hamburgueria SevenKings', 'opensAt'=> '11:00', 'closesAt' => '23:00'],
            ['X' => 1, 'Y' => 1, 'id' => 3, 'name'=> 'Nerdbunker', 'opensAt'=> '12:00', 'closesAt' => '18:00'],
            ['X' => 7, 'Y' => 9, 'id' => 6, 'name'=> 'Posto de gasolina', 'opensAt'=> '07:00', 'closesAt' => '23:00'],
        ];

        $expected = [
            ['X' => 2, 'Y' => 4, 'id' => 5, 'name'=> 'Loja Magalu', 'opensAt'=> '09:00', 'closesAt' => '21:00', 'status'=> 'open'],
            ['X' => 8, 'Y' => 12, 'id' => 8, 'name'=> 'Hamburgueria SevenKings', 'opensAt'=> '11:00', 'closesAt' => '23:00', 'status'=> 'closed'],
            ['X' => 1, 'Y' => 1, 'id' => 3, 'name'=> 'Nerdbunker', 'opensAt'=> '12:00', 'closesAt' => '18:00', 'status'=> 'closed'],
            ['X' => 7, 'Y' => 9, 'id' => 6, 'name'=> 'Posto de gasolina', 'opensAt'=> '07:00', 'closesAt' => '23:00', 'status'=> 'open'],
        ];

        $helper = new LocationHelper();
        $actual = $helper->checkOpenLocation('10:00', $locations);

        $this->assertEquals( $expected, $actual );
    }
}
