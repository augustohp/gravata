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
    Behat\Mink\Exception;


class FeatureContext extends BehatContext
{
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

}
