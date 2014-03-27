<?php
namespace Gravata\Test\Context;

use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode,
    Behat\Mink\Driver\GoutteDriver,
    Behat\Mink\Session,
    Behat\Mink\Exception,
    Behat\Behat\Context\Step;


class FeatureContext extends BehatContext
{
    const GRAVATAR_EMAIL = 'augusto@phpsp.org.br';
    private $siteUrl = '';
    private $driver = null;
    private $session = null;

    public function __construct(array $parameters)
    {
        $this->siteUrl = $parameters['url'];
        $this->driver = new GoutteDriver;
        $this->session = new Session($this->driver);
    }

    /**
     * @Given /^I visit homepage$/
     */
    public function iVisitHomepage()
    {
        $this->session->start();

        $this->session->visit($this->siteUrl);

        if ($this->siteUrl !== $this->session->getCurrentUrl()) {
            throw new \Exception('Current url is different from homepage');
        }
    }

    /**
     * @Given /^I type "([^"]*)" as the e-mail$/
     */
    public function iTypeAsTheEMail($email)
    {
        $page = $this->session->getPage();

        $emailElement = $page->findField('email');
        if (!$emailElement) {
           throw new Exception\ElementNotFoundException($this->session);
        }

        $emailElement->setValue($email);
    }

    /**
     * @When /^I click Search$/
     */
    public function iClickSearch()
    {
        $page = $this->session->getPage();
        $searchButton = $page->findButton('Search');
        $searchButton->click();
    }

    /**
     * @Then /^I should see my avatar$/
     */
    public function iShouldSeeMyAvatar()
    {
        $expectedHost = 'http://www.gravatar.com/avatar/';
        $currentUrl = $this->session->getCurrentUrl();
        if (false === strpos($currentUrl, $expectedHost)) {
            throw new \Exception('Not on avatar URL');
        }
    }
    /**
     * @Then /^I should have a file named "([^"]*)" in "([^"]*)" dir$/
     */
    public function iShouldHaveAFileNamedInDir($filename, $dirname)
    {
        $filePath = rtrim($dirname, '/') . '/' . $filename;
        if (false === file_exists($filePath)) {
            throw new \Exception(sprintf("File %s does not exist in dir %s", $filename, $dirname));
        }
    }

    /**
     * @When /^I search for an avatar$/
     */
    public function iSearchForAnAvatar()
    {
        $avatarEmail = self::GRAVATAR_EMAIL;
        $filename = sprintf('%s.jpeg', $avatarEmail);
        return array(
            new Step\Given(sprintf('I type "%s" as the e-mail', $avatarEmail)),
            new Step\When('I click Search'),
            new Step\Then(sprintf('I should have a file named "%s" in "/tmp" dir', $filename))
        );
    }

    /**
     * @Then /^I should see my avatar with a nice tie$/
     */
    public function iShouldSeeMyAvatarWithANiceTie()
    {
        $fixturePath = __DIR__.'/../../../../tests/fixtures';
        $gravataAppliedImagePath = sprintf('%s/gravata_augusto-phpsp-org-br_70.jpeg', $fixturePath);
        $expectedMd5 = 'af186f6460138dc37a731f5f693b34da';
        $downloadedImagesDirectory = '/tmp';
        $resultFilename = sprintf('%s/gravata_%s.jpeg', $downloadedImagesDirectory, self::GRAVATAR_EMAIL);
        $responseHeaders = $this->session->getResponseHeaders();

        if ('image/jpeg' !== current($responseHeaders['content-type'])) {
            throw new \Exception('Content-Type is not an image');
        }

        if (false === file_exists($resultFilename)) {
            throw new \Exception(sprintf('Resulting file %s not found.', $resultFilename));
        }

        $resultMd5 = md5(file_get_contents($resultFilename));
        if ($resultMd5 != $expectedMd5) {
            throw new \Exception(sprintf('Resulting file md5 hash mismatch. (Expected %s, given %s)', $expectedMd5, $resultMd5));
            @unlink($resultFilename);
        }
    }
}
