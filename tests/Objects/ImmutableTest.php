<?php
declare(strict_types=1);

namespace FunctionalTools\Tests\Objects;

use LogicException;
use TypeError;
use PHPUnit\Framework\TestCase;
use FunctionalTools\Objects\Immutable;
use FunctionalTools\Strings;

class ImmutableTest extends TestCase
{
    public function testGet()
    {
        $targetObj = new class('publicValue', 'protectedValue', 'privateValue') {
            use Immutable;

            public $publicProp;
            protected $protectedProp;
            private $privateProp;

            public function __construct($publicProp, $protectedProp, $privateProp)
            {
                $this->publicProp = $publicProp;
                $this->protectedProp = $protectedProp;
                $this->privateProp = $privateProp;
            }
        };

        // can read public property.
        $actual = $targetObj->publicProp;
        $this->assertSame('publicValue', $actual);

        // can read protected property.
        $actual = $targetObj->protectedProp;
        $this->assertSame('protectedValue', $actual);

        // can read private property.
        $actual = $targetObj->privateProp;
        $this->assertSame('privateValue', $actual);
    }

    public function testGetNothing()
    {
        $targetObj = new class('publicValue', 'protectedValue', 'privateValue') {
            use Immutable;

            public $publicProp;
            protected $protectedProp;
            private $privateProp;

            public function __construct($publicProp, $protectedProp, $privateProp)
            {
                $this->publicProp = $publicProp;
                $this->protectedProp = $protectedProp;
                $this->privateProp = $privateProp;
            }
        };

        // with nothing property, throw LogicException.
        $this->expectException(LogicException::class);
        $_actual = $targetObj->nothingProp;
    }

    public function testSetPublic()
    {
        $targetObj = new class('publicValue') {
            use Immutable;

            public $publicProp;

            public function __construct($publicProp)
            {
                $this->publicProp = $publicProp;
            }
        };

        // can write public property.
        $targetObj->publicProp = 'updated';
        $actual = $targetObj->publicProp;
        $this->assertSame('updated', $actual);
    }

    public function testSetProtected()
    {
        $targetObj = new class('protectedValue') {
            use Immutable;

            protected $protectedProp;

            public function __construct($protectedProp)
            {
                $this->protectedProp = $protectedProp;
            }
        };

        // can not write protected property.
        $this->expectException(LogicException::class);
        $targetObj->protectedProp = 'updated';
    }

    public function testSetPrivate()
    {
        $targetObj = new class('privateValue') {
            use Immutable;

            private $privateProp;

            public function __construct($privateProp)
            {
                $this->privateProp = $privateProp;
            }
        };

        // can not write private property.
        $this->expectException(LogicException::class);
        $targetObj->privateProp = 'updated';
    }

    public function testSetNothing()
    {
        $targetObj = new class() {
            use Immutable;

            // nothing properties

            public function __construct()
            {
            }
        };

        // can not write nothing property.
        $this->expectException(LogicException::class);
        $targetObj->nothingProp = 'updated';
    }

    public function testSetProperty()
    {
        $targetObj = new class('publicValue', 1, true) {
            use Immutable;

            public ?string $publicStringProp;
            protected int $protectedIntProp;
            private bool $privateBoolProp;

            public function __construct(?string $publicStringProp, int $protectedIntProp, bool $privateBoolProp)
            {
                $this->publicStringProp = $publicStringProp;
                $this->protectedIntProp = $protectedIntProp;
                $this->privateBoolProp = $privateBoolProp;
            }
        };
        $originalObj = clone $targetObj;

        // can update public property
        $updatedObj = $targetObj->setProperty('publicStringProp', 'updated');
        $actual = [
            $updatedObj->publicStringProp,
            $updatedObj->protectedIntProp,
            $updatedObj->privateBoolProp,
        ];
        $this->assertSame(['updated', 1, true], $actual);

        // can update protected property
        $updatedObj = $targetObj->setProperty('protectedIntProp', 2);
        $actual = [
            $updatedObj->publicStringProp,
            $updatedObj->protectedIntProp,
            $updatedObj->privateBoolProp,
        ];
        $this->assertSame(['publicValue', 2, true], $actual);

        // can update private property
        $updatedObj = $targetObj->setProperty('privateBoolProp', false);
        $actual = [
            $updatedObj->publicStringProp,
            $updatedObj->protectedIntProp,
            $updatedObj->privateBoolProp,
        ];
        $this->assertSame(['publicValue', 1, false], $actual);

        // do not modified original object
        $this->assertEquals($originalObj, $targetObj);
    }

    public function testSetPropertyNothing()
    {
        $targetObj = new class('publicValue', 1, true) {
            use Immutable;

            public ?string $publicStringProp;
            protected int $protectedIntProp;
            private bool $privateBoolProp;

            public function __construct(?string $publicStringProp, int $protectedIntProp, bool $privateBoolProp)
            {
                $this->publicStringProp = $publicStringProp;
                $this->protectedIntProp = $protectedIntProp;
                $this->privateBoolProp = $privateBoolProp;
            }
        };

        // with nothing property, throw LogicException.
        $this->expectException(LogicException::class);
        $_actual = $targetObj->setProperty('nothingProp', 'updated');
    }

    public function testSetPropertyInvalidType()
    {
        $targetObj = new class('publicValue') {
            use Immutable;

            public ?string $publicStringProp;

            public function __construct(?string $publicStringProp)
            {
                $this->publicStringProp = $publicStringProp;
            }
        };

        // with invalid type , throw LogicException.
        $this->expectException(TypeError::class);
        $_actual = $targetObj->setProperty('publicStringProp', 1);
    }

    public function testSetProperties()
    {
        $targetObj = new class('publicValue', 1, true) {
            use Immutable;

            public ?string $publicStringProp;
            protected int $protectedIntProp;
            private bool $privateBoolProp;

            public function __construct(?string $publicStringProp, int $protectedIntProp, bool $privateBoolProp)
            {
                $this->publicStringProp = $publicStringProp;
                $this->protectedIntProp = $protectedIntProp;
                $this->privateBoolProp = $privateBoolProp;
            }
        };
        $originalObj = clone $targetObj;

        // can update public property
        $updatedObj = $targetObj->setProperties([
            'publicStringProp' => 'updated',
            'protectedIntProp' => 2,
            'privateBoolProp' => false,
        ]);
        $actual = [
            $updatedObj->publicStringProp,
            $updatedObj->protectedIntProp,
            $updatedObj->privateBoolProp,
        ];
        $this->assertSame(['updated', 2, false], $actual);

        // do not modified original object
        $this->assertEquals($originalObj, $targetObj);
    }

    public function testSetPropertiesNothing()
    {
        $targetObj = new class('publicValue', 1, true) {
            use Immutable;

            public ?string $publicStringProp;
            protected int $protectedIntProp;
            private bool $privateBoolProp;

            public function __construct(?string $publicStringProp, int $protectedIntProp, bool $privateBoolProp)
            {
                $this->publicStringProp = $publicStringProp;
                $this->protectedIntProp = $protectedIntProp;
                $this->privateBoolProp = $privateBoolProp;
            }
        };

        // with nothing property, throw LogicException.
        $this->expectException(LogicException::class);
        $_actual = $targetObj->setProperty('nothingProp', 'updated');
    }

    public function testSetPropertiesInvalidType()
    {
        $targetObj = new class('publicValue') {
            use Immutable;

            public ?string $publicStringProp;

            public function __construct(?string $publicStringProp)
            {
                $this->publicStringProp = $publicStringProp;
            }
        };

        // with invalid type , throw LogicException.
        $this->expectException(TypeError::class);
        $_actual = $targetObj->setProperty('publicStringProp', 1);
    }

}
