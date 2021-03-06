<?php

namespace Kalendas\Writers;

use Kalendas\WeekFormatter;

class OoxmlWriterConfiguration
{
    const ONE_LETTER = 'oneLetter';
    const SHORT = 'short';
    const FULL = 'full';

    /**
     * @var array
     */
    private $defaultStyles;

    /**
     * @var array
     */
    private $defaultDayFormats;

    /**
     * @var bool
     */
    private $isCustom;

    /**
     * @var string
     */
    private $filename;

    public function __construct()
    {
        $this->defaultDayFormats = [
            self::ONE_LETTER => WeekFormatter::oneLetter(),
            self::SHORT => WeekFormatter::short(),
            self::FULL => WeekFormatter::full(),
        ];

        $this->defaultStyles = [
            'headerHeight' => 500,
            'weekHeight' => [
                4 => 1900,
                5 => 1500,
                6 => 1250,
            ],
            'title' => [
                'size' => 20,
                'bold' => true,
                'color' => '000000',
            ],
            'header' => [
                'size' => 14,
                'bold' => true,
                'color' => '424242',
                'align' => 'center',
                'bgColor' => 'cccccc',
            ],
            'weekDay' => [
                'align' => 'right',
                'size' => 11,
            ],
            'weekCell' => [
                'bgColor' => 'ffffff',
            ],
            'weekendCell' => [
                'bgColor' => 'eaeaea',
            ],
            'dayFormat' => self::FULL,
        ];
    }

    /**
     * @param array $styles
     *
     * @return OoxmlWriterConfiguration
     */
    public function setTitleStyle(array $styles)
    {
        return $this->setStyle('title', $styles);
    }

    /**
     * @param array $styles
     *
     * @return OoxmlWriterConfiguration
     */
    public function setHeaderStyle(array $styles)
    {
        return $this->setStyle('header', $styles);
    }

    /**
     * @param array $styles
     *
     * @return OoxmlWriterConfiguration
     */
    public function setWeekDayStyle(array $styles)
    {
        return $this->setStyle('weekDay', $styles);
    }

    /**
     * @param array $styles
     *
     * @return OoxmlWriterConfiguration
     */
    public function setWeekCellStyle(array $styles)
    {
        return $this->setStyle('weekCell', $styles);
    }

    /**
     * @param array $styles
     *
     * @return OoxmlWriterConfiguration
     */
    public function setWeekendCellStyle(array $styles)
    {
        return $this->setStyle('weekendCell', $styles);
    }

    /**
     * @param string $format
     *
     * @return OoxmlWriterConfiguration
     */
    public function setDayFormat($format)
    {
        $this->defaultStyles['dayFormat'] = $format;

        $this->isCustom = true;

        return $this;
    }

    /**
     * @param string $filename
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;
    }

    /**
     * @return array
     */
    public function titleStyles()
    {
        return $this->defaultStyles['title'];
    }

    /**
     * @return int
     */
    public function headerHeight()
    {
        return $this->defaultStyles['headerHeight'];
    }

    /**
     * @return array
     */
    public function headerStyles()
    {
        return $this->defaultStyles['header'];
    }

    /**
     * @param int $numberOfWeeks
     *
     * @return int
     */
    public function weekHeight($numberOfWeeks)
    {
        return $this->defaultStyles['weekHeight'][$numberOfWeeks];
    }

    /**
     * @return array
     */
    public function weekCellStyle()
    {
        return $this->defaultStyles['weekCell'];
    }

    /**
     * @return array
     */
    public function weekendCellStyle()
    {
        return $this->defaultStyles['weekendCell'];
    }

    /**
     * @return array
     */
    public function weekDayStyle()
    {
        return $this->defaultStyles['weekDay'];
    }

    /**
     * @return array
     */
    public function days()
    {
        return $this->defaultDayFormats[$this->defaultStyles['dayFormat']];
    }

    /**
     * @return array
     */
    public function dayFormat()
    {
        return $this->defaultStyles['dayFormat'];
    }

    /**
     * @return string
     */
    public function filename()
    {
        return $this->filename;
    }

    /**
     * @return bool
     */
    public function isCustom()
    {
        return $this->isCustom;
    }

    /**
     * @param string $section
     * @param array $styles
     *
     * @return OoxmlWriterConfiguration
     */
    private function setStyle($section, array $styles)
    {
        $this->defaultStyles[$section] = array_merge(
            $this->defaultStyles[$section],
            $styles
        );

        $this->isCustom = true;

        return $this;
    }
}