<?php

namespace Sniffs;

class FixtureTest extends \AbstractPhpcsTestCase
{
    /** {@inheritdoc} */
    public function fixtureSniffProvider()
    {
        // get fixture definitions from file
        $fixtures = array();
        $fixturePath = __DIR__ . '/_fixtures';
        $it = new \FilesystemIterator($fixturePath);
        foreach ($it as $fi) {
            $fn = substr($fi->getFilename(), -8);
            if ($fi->isFile() && $fn == '.def.php') {
                $fixture = require($fi->getPathname());
                $fixture[0] = $fixturePath . '/' . $fixture[0];
                $fixtures[] = $fixture;
            }
        }

        return $fixtures;
    }
}
