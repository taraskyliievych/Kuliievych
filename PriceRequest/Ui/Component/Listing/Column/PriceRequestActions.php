<?php
declare(strict_types=1);

namespace Kuliievych\PriceRequest\Ui\Component\Listing\Column;

class PriceRequestActions extends \Magento\Ui\Component\Listing\Columns\Column
{
    protected $urlBuilder;
    const URL_PATH_DETAILS = 'kuliievych_pricerequest/pricerequest/details';
    const URL_PATH_DELETE = 'kuliievych_pricerequest/pricerequest/delete';
    const URL_PATH_EDIT = 'kuliievych_pricerequest/pricerequest/edit';
    const STATUSES = ['New', 'In progress', 'Closed'];

    /**
     * @param \Magento\Framework\View\Element\UiComponent\ContextInterface $context
     * @param \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory
     * @param \Magento\Framework\UrlInterface $urlBuilder
     * @param array $components
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\UiComponent\ContextInterface $context,
        \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory,
        \Magento\Framework\UrlInterface $urlBuilder,
        array $components = [],
        array $data = []
    ) {
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                if (isset($item['request_id'])) {
                    $item['status'] = self::STATUSES[$item['status']];
                    $item[$this->getData('name')] = [
                        'edit' => [
                            'href' => $this->urlBuilder->getUrl(
                                static::URL_PATH_EDIT,
                                [
                                    'request_id' => $item['request_id']
                                ]
                            ),
                            'label' => __('Edit')
                        ],
                        'delete' => [
                            'href' => $this->urlBuilder->getUrl(
                                static::URL_PATH_DELETE,
                                [
                                    'request_id' => $item['request_id']
                                ]
                            ),
                            'label' => __('Delete'),
                            'confirm' => [
                                'title' => __('Delete request for ') . $item['name'],
                                'message' => __('Are you sure you wan\'t to delete a request for ') . $item['name']
                            ]
                        ]
                    ];
                }
            }
        }

        return $dataSource;
    }
}
