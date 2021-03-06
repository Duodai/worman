<?php
declare(strict_types=1);


namespace duodai\worman\components\processTracker\dto;


class ProcessInfo
{
    const PROCESS_ID_ARRAY_KEY = 'processId';
    const CLASS_ARRAY_KEY = 'class';
    const START_TIME_ARRAY_KEY = 'startTime';
    const FINISH_TIME_ARRAY_KEY = 'finishTime';
    const PEAK_MEMORY_USAGE_ARRAY_KEY = 'peakMemory';
    const ERROR_CODE_ARRAY_KEY = 'errorCode';
    const ERROR_MESSAGE_ARRAY_KEY = 'errorMessage';

    /**
     * @var string
     */
    protected $class;
    /**
     * @var int
     */
    protected $startTime;
    /**
     * @var int
     */
    protected $finishTime;
    /**
     * @var int
     */
    protected $errorCode;
    /**
     * @var string
     */
    protected $errorMessage;
    /**
     * @var int
     */
    protected $peakMemoryUsage;

    /**
     * @var int
     */
    protected $processId;

    /**
     * @var int
     */
    protected $id;

    /**
     * ProcessInfo constructor.
     * @param string $class
     * @param int $pid
     * @param int $startTime
     */
    public function __construct(string $class, int $pid, int $startTime)
    {
        if (!class_exists($class)) {
            throw new \InvalidArgumentException('Invalid worker class');
        }
        if ($startTime < 0) {
            throw new \InvalidArgumentException(__METHOD__ . ' error: start time must be a unix timestamp');
        }
        $this->class = $class;
        $this->processId = $pid;
        $this->startTime = $startTime;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getDuration()
    {
        $duration = $this->finishTime - $this->startTime;
        return $duration;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            self::PROCESS_ID_ARRAY_KEY => $this->getProcessId(),
            self::START_TIME_ARRAY_KEY => $this->getStartTime(),
            self::CLASS_ARRAY_KEY => $this->getClass(),
            self::FINISH_TIME_ARRAY_KEY => $this->getFinishTime(),
            self::PEAK_MEMORY_USAGE_ARRAY_KEY => $this->getPeakMemoryUsage(),
            self::ERROR_CODE_ARRAY_KEY => $this->getErrorCode(),
            self::ERROR_MESSAGE_ARRAY_KEY => $this->getErrorMessage()
        ];
    }

    /**
     * @return int
     */
    public function getProcessId(): int
    {
        return $this->processId;
    }

    /**
     * @return int
     */
    public function getStartTime(): int
    {
        return $this->startTime;
    }

    /**
     * @return string
     */
    public function getClass(): string
    {
        return $this->class;
    }

    /**
     * @return int
     */
    public function getFinishTime(): int
    {
        return $this->finishTime;
    }

    /**
     * @param int $time
     */
    public function setFinishTime(int $time)
    {
        $this->finishTime = $time;
    }

    /**
     * @return int
     */
    public function getPeakMemoryUsage(): int
    {
        return $this->peakMemoryUsage;
    }

    /**
     * @param int $peakMemoryUsage
     */
    public function setPeakMemoryUsage(int $peakMemoryUsage): void
    {
        $this->peakMemoryUsage = $peakMemoryUsage;
    }

    /**
     * @return int
     */
    public function getErrorCode(): int
    {
        return $this->errorCode;
    }

    /**
     * @param int $errorCode
     */
    public function setErrorCode(int $errorCode): void
    {
        $this->errorCode = $errorCode;
    }

    /**
     * @return string
     */
    public function getErrorMessage(): string
    {
        return $this->errorMessage;
    }

    /**
     * @param string $errorMessage
     */
    public function setErrorMessage(string $errorMessage): void
    {
        $this->errorMessage = $errorMessage;
    }
}