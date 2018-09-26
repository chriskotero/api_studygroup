<?php
/**
 * Class NextMeetupCommand
 *
 * @package Acme
 * @author  Emily Stamey
 */

namespace Acme\Command;

use Acme\Meetup;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class NextMeetupCommand extends Command
{
    protected $config;

    protected $meetup;

    protected $groups = [
        'tp' => 'trianglephp',
        'wwcrd' => 'Women-Who-Code-Raleigh-Durham',
    ];

    public function __construct($config = [])
    {
        // best practices recommend to call the parent constructor first and
        // then set your own properties. That wouldn't work in this case
        // because configure() needs the properties set in this constructor
        $this->config = $config;

        $this->meetup = new Meetup(array(
            'key' => $this->config['key']
        ));

        parent::__construct();
    }

    protected function configure()
    {
        $this
            // the name of the command (the part after "bin/console")
            ->setName('next-meetup')

            // the short description shown while running "php bin/console list"
            ->setDescription('Look up the next meetup.')

            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('This command allows you to find when the next meetup will be for a chosen group: ' . $this->getGroupCodes())

            ->addArgument('group', InputArgument::REQUIRED, 'The short name of the meetup group')
            ->addArgument('count', InputArgument::OPTIONAL, 'The count of meetups that should be returned', 1)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $group = $this->lookupGroup($input->getArgument('group'));
        } catch (\Exception $e) {
            $output->writeln('<error>' . $e->getMessage() . '</error>');
        }

        $response = $this->meetup->getEvents(
            ['group_urlname' => $group]
        );

        $count = $input->getArgument('count');

        for ($i=0; $i < $count; $i++) {
            $date =  new \DateTime('@' . $response[$i]->time / 1000);
            $date->setTimezone(new \DateTimezone('America/New_York'));

            $group = $response[$i]->group->name;
            $place =  $response[$i]->venue->name;
            $url =  $response[$i]->event_url;
            $title = $response[$i]->name;

            $output->writeln([
                'Next Meetup for ' . $group,
                '===========================',
                '',
            ]);

            $output->writeln($title);
            $output->writeln($date->format("D, M j H:i"));
            $output->writeln('location: '. $place);
            $output->writeln($url);
            $output->writeln('');
        }

    }

    private function lookupGroup($groupShortName)
    {
        if (!isset($this->groups[$groupShortName])) {
            throw new \Exception("This group code doesn't exist");
        }

        return $this->groups[$groupShortName];
    }

    private function getGroupCodes()
    {
        return implode(', ', array_keys($this->groups));
    }

    private function printPrettyMeetup($group, $place, $url, $title)
    {
        $output->writeln([
            'Next Meetup',
            '============',
            '',
        ]);
    }
}