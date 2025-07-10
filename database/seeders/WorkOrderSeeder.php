<?php

namespace Database\Seeders;

use App\Models\Contact;
use App\Models\User;
use App\Models\WorkOrder;
use App\WorkOrderPriority;
use App\WorkOrderStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WorkOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contacts = Contact::all();
        $users = User::where('is_employee', true)->get();
        
        $workOrders = [
            [
                'work_order_number' => 'WO2025-0001',
                'title' => 'Reparasjon av vinduer',
                'description' => 'Utskifting av ødelagte vinduer i andre etasje. Tre vinduer trenger ny tetting og lås.',
                'status' => WorkOrderStatus::IN_PROGRESS,
                'priority' => WorkOrderPriority::NORMAL,
                'contact_id' => $contacts->first()->id ?? null,
                'customer_name' => 'Stavanger Kommune',
                'customer_email' => 'post@stavanger.kommune.no',
                'customer_phone' => '51 50 70 00',
                'assigned_to' => $users->first()->id ?? null,
                'due_date' => now()->addDays(7),
                'started_at' => now()->subDays(2),
                'estimated_hours' => 8,
                'actual_hours' => 5,
                'location' => 'Stavanger Rådhus, 2. etasje',
                'equipment' => 'Vinduer og beslag',
                'equipment_serial' => 'WIN-2024-001',
                'estimated_cost' => 15000,
                'actual_cost' => 12000,
                'billable' => true,
                'internal_notes' => 'Kunde ønsker arbeid utført på dagtid. Kontakt vaktmester før ankomst.',
                'customer_notes' => 'Tilgang via hovedinngang. Meld fra til resepsjon ved ankomst.',
                'checklist' => [
                    ['task' => 'Demontere gamle vinduer', 'completed' => true],
                    ['task' => 'Installere nye vinduer', 'completed' => true],
                    ['task' => 'Montere beslag og låser', 'completed' => false],
                    ['task' => 'Test åpning/lukking', 'completed' => false],
                ],
                'parts_used' => [
                    ['part_name' => 'Vindu 120x80cm', 'quantity' => 3, 'cost' => 2500, 'notes' => 'Hvit ramme, trippelglass'],
                    ['part_name' => 'Vindusbeslag sett', 'quantity' => 3, 'cost' => 500, 'notes' => 'Inkludert skruer'],
                ],
            ],
            [
                'work_order_number' => 'WO2025-0002',
                'title' => 'Elektrisk installasjon',
                'description' => 'Ny elektrisk installasjon i kjelleren. Inkluderer sikringsskap og 10 stikkontakter.',
                'status' => WorkOrderStatus::PENDING,
                'priority' => WorkOrderPriority::HIGH,
                'contact_id' => $contacts->skip(1)->first()->id ?? null,
                'customer_name' => 'Bergeland Bygg AS',
                'customer_email' => 'post@bergeland.no',
                'customer_phone' => '51 23 45 67',
                'assigned_to' => $users->skip(1)->first()->id ?? $users->first()->id ?? null,
                'due_date' => now()->addDays(14),
                'estimated_hours' => 16,
                'location' => 'Bergeland Næringspark, Bygg A',
                'equipment' => 'Sikringsskap og kabler',
                'estimated_cost' => 25000,
                'billable' => true,
                'internal_notes' => 'Krever autorisert elektrikert. Kontakt før oppstart.',
                'customer_notes' => 'Arbeid kan utføres i helger. Nøkkel i depot.',
                'checklist' => [
                    ['task' => 'Planlegge kabelføring', 'completed' => false],
                    ['task' => 'Montere sikringsskap', 'completed' => false],
                    ['task' => 'Trekke kabler', 'completed' => false],
                    ['task' => 'Installere stikkontakter', 'completed' => false],
                    ['task' => 'Koble til sikringsskap', 'completed' => false],
                    ['task' => 'Test installasjon', 'completed' => false],
                ],
                'parts_used' => [],
            ],
            [
                'work_order_number' => 'WO2025-0003',
                'title' => 'Service på ventilasjonsanlegg',
                'description' => 'Årlig service og rengjøring av ventilasjonsanlegg. Inkluderer filterskift og kontroll.',
                'status' => WorkOrderStatus::COMPLETED,
                'priority' => WorkOrderPriority::LOW,
                'contact_id' => $contacts->skip(2)->first()->id ?? null,
                'customer_name' => 'Rogaland Eiendom',
                'customer_email' => 'drift@rogaland-eiendom.no',
                'customer_phone' => '51 87 65 43',
                'assigned_to' => $users->first()->id ?? null,
                'due_date' => now()->subDays(5),
                'started_at' => now()->subDays(7),
                'completed_at' => now()->subDays(5),
                'estimated_hours' => 4,
                'actual_hours' => 3,
                'location' => 'Stavanger Business Park',
                'equipment' => 'Ventilasjonsanlegg VVS-101',
                'equipment_serial' => 'VVS-101-2020',
                'estimated_cost' => 5000,
                'actual_cost' => 4200,
                'billable' => true,
                'internal_notes' => 'Anlegget er i god stand. Neste service om 12 måneder.',
                'customer_notes' => 'Service utført som planlagt. Filtere skiftet og system testet.',
                'checklist' => [
                    ['task' => 'Inspisere vifter', 'completed' => true],
                    ['task' => 'Rense luftkanaler', 'completed' => true],
                    ['task' => 'Skifte filtre', 'completed' => true],
                    ['task' => 'Teste luftflow', 'completed' => true],
                    ['task' => 'Dokumentere service', 'completed' => true],
                ],
                'parts_used' => [
                    ['part_name' => 'Luftfilter G4', 'quantity' => 4, 'cost' => 200, 'notes' => 'Standard filtere'],
                    ['part_name' => 'Luftfilter F7', 'quantity' => 2, 'cost' => 400, 'notes' => 'Finfiltre'],
                ],
            ],
            [
                'work_order_number' => 'WO2025-0004',
                'title' => 'KRITISK: Vannskade reparasjon',
                'description' => 'Akutt vannskade i 1. etasje etter rørbrudd. Krever umiddelbar innsats.',
                'status' => WorkOrderStatus::WAITING_PARTS,
                'priority' => WorkOrderPriority::CRITICAL,
                'contact_id' => $contacts->skip(3)->first()->id ?? null,
                'customer_name' => 'Sandnes Sykehjem',
                'customer_email' => 'drift@sandnes-sykehjem.no',
                'customer_phone' => '51 97 00 00',
                'assigned_to' => $users->first()->id ?? null,
                'due_date' => now()->addHours(12),
                'started_at' => now()->subHours(2),
                'estimated_hours' => 12,
                'actual_hours' => 8,
                'location' => 'Sandnes Sykehjem, Øst-fløy 1. etasje',
                'equipment' => 'Vanngulv og rør',
                'estimated_cost' => 35000,
                'actual_cost' => 28000,
                'billable' => true,
                'internal_notes' => 'KRITISK SITUASJON! Pasienter evakuert fra berørte rom. Kontakt prosjektleder umiddelbart.',
                'customer_notes' => 'Arbeid pågår. Venter på spesialrør. Temporær løsning på plass.',
                'checklist' => [
                    ['task' => 'Stoppe vannlekkasje', 'completed' => true],
                    ['task' => 'Pumpe ut vann', 'completed' => true],
                    ['task' => 'Vurdere skadeomfang', 'completed' => true],
                    ['task' => 'Bestille nye rør', 'completed' => true],
                    ['task' => 'Installere nye rør', 'completed' => false],
                    ['task' => 'Teste system', 'completed' => false],
                    ['task' => 'Reparere gulv', 'completed' => false],
                ],
                'parts_used' => [
                    ['part_name' => 'Avgrensingsstøt', 'quantity' => 2, 'cost' => 500, 'notes' => 'Akutt reparasjon'],
                ],
            ],
        ];
        
        foreach ($workOrders as $workOrderData) {
            WorkOrder::create($workOrderData);
        }
    }
}
