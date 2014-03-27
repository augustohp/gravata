Feature: Download avatar from gravatar
    In order to have an image to apply a tie
    As a gravatar user
    I must be able to download an avatar

Scenario: Download avatar from gravatar
    Given I visit homepage
    And I type "augusto@phpsp.org.br" as the e-mail
    When I click Search
    Then I should have a file named "augusto@phpsp.org.br.jpeg" in "/tmp" dir
